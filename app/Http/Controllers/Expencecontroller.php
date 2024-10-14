<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Earning;
use App\Models\Expence;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class Expencecontroller extends Controller
{
    public function expence(){
        $userId = Auth::id();
        $expence=Expence::where('user_id',$userId)->get();
        return view('Earningexpence.expence',compact('expence'));
    }

    public function Addexpence(Request $request){
        $request->validate([
            'expenceName.*' => 'required|string|max:255',
            'expenceAmount.*' => 'required|numeric',
            'expenceMonth.*' => 'required|integer|between:1,12',
        ]);
        $currentMonth = Carbon::now()->month;


        $userId = Auth::id();
        foreach ($request->expenceName as $index => $expenceName) {
            Expence::create([
                'user_id' => $userId,
                'area_of_expence' => $expenceName,
                'amount' => $request->expenceAmount[$index],
                'month' => $request->expenceMonth[$index],
            ]);
        }

        $totalearning= Earning::where('user_id',$userId)
        ->where('month',$currentMonth)->sum('amount');

        $totalexpence= Expence::where('user_id',$userId)
        ->where('month',$currentMonth)->sum('amount');

        $payment=Payment::where('user_id',$userId)
        ->where('month',$currentMonth)->first();

        if($payment==null){
            $payment= new Payment();
            $payment->total_amount=$totalearning;
            $payment->remaining_amount=$totalearning-$totalexpence;
            $payment->month=$currentMonth;
            $payment->user_id=$userId;
            $payment->save();
        }else{

            $payment->update([
                'remaining_amount' => $totalearning - $totalexpence
            ]);
        }
        return redirect()->back()->with('success', 'Expence saved successfully!');
    }

    public function editExpence($id){
        $expense = Expence::findOrFail($id);
           return view('EarningExpence.editexpence',compact('expense'));
    }


    public function updateexpence(Request $request,$id){
        $request->validate([
            'area_of_expence' => 'required',
            'amount' => 'required|numeric',
            'month_number' => 'required|integer|min:1|max:12'
        ]);

        $expence = Expence::findOrFail($id);
        $expence->update([
            'area_of_expence' => $request->input('area_of_expence'),
            'amount' => $request->input('amount'),
            'month' => $request->input('month_number'),
        ]);

        return redirect()->route('Expence')->with('success', 'Earnings saved successfully!');
    }


    public function Deleteexpence($id){
        $expence = Expence::find($id);
        if ($expence) {
            $expence->delete();
            return redirect()->route('Expence')->with('success', 'Expence deleted successfully.');
        }
        return redirect()->route('Expence')->with('error', 'Expence not found.');
    }


    public function Deleteearning($id) {
        $earning = Earning::find($id);
        if ($earning) {
            $earning->delete();
            return redirect()->route('Earningexpence')->with('success', 'Earning deleted successfully.');
        }
        return redirect()->route('Earningexpence')->with('error', 'Earning not found.');
    }

}
