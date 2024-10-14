<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Earning;
use App\Models\Expence;
use App\Models\Payment;
use App\Models\Investment;
use Illuminate\Support\Facades\Auth;
class investmentcontroller extends Controller
{
    public function investment(){
        $userId = Auth::id();
        $investments=Investment::where('user_id',$userId)->get();

        return view('Investments.investments',compact('investments'));
    }


    public function Addinvestment(Request $request){
        $userId = Auth::id();
        $request->validate([
            'investmentarea' => 'required',
            'amount' => 'required|numeric',
            'interest' => 'required|integer|min:1|max:12',
            'period' => 'required',
            'month' => 'required',

         ]);
         $investment = new Investment(); // Corrected variable name and class casing
         $investment->investment_area = $request->investmentarea;
         $investment->amount = $request->amount;
         $investment->rate_of_interest = $request->interest;
         $investment->period = $request->period;
         $investment->month = $request->month; // Added missing assignment for month
         $investment->user_id = $userId;
         $investment->save();

         $payment=Payment::where('user_id',$userId)->first();
         $payment->update([
            'remaining_amount' => $payment->remaining_amount - $request->amount,

        ]);
         return redirect()->route('investment')->with('error', 'Earning not found.');
    }

    public function editInvestment($id){
        $editInvestment = Investment::findOrFail($id);
        return view('Investments.editinvestment',compact('editInvestment'));
    }

    public function UpdateInvestment(Request $request, $id) {
        $request->validate([
            'investmentarea' => 'required',
            'amount' => 'required',
            'month_number' => 'required',
            'rate_of_interest' => 'required',
            'period' => 'required',
        ]);

        $investment = Investment::findOrFail($id);

        $investment->update([
            'investment_area' => $request->input('investmentarea'),
            'amount' => $request->input('amount'),
            'month_number' => $request->input('month_number'),
            'rate_of_interest' => $request->input('rate_of_interest'),
            'period' => $request->input('period'),
        ]);

        return redirect()->route('Expence')->with('success', 'Investment updated successfully!');
    }


    public function Deleteinvestment($id){
        $investment = Investment::find($id);
        if ($investment) {
            $investment->delete();
            return redirect()->route('investment')->with('success', 'Expence deleted successfully.');
        }
        return redirect()->route('investment')->with('error', 'Expence not found.');
    }


}
