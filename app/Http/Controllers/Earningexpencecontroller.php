<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Earning;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class Earningexpencecontroller extends Controller
{
    public function Earningexpence() {
        $userId = Auth::id();
        $currentMonth = Carbon::now()->month;
        $earnings = Earning::where('user_id', $userId)
        ->where('month', $currentMonth)
        ->get();
        $totalearning= Earning::where('user_id',$userId)
        ->where('month',$currentMonth)->sum('amount');
        return view('EarningExpence.earningexpence', compact('earnings','totalearning'));
    }


    public function Addearning(Request $request) {

        $request->validate([
            'earningName.*' => 'required|string|max:255',
            'earningAmount.*' => 'required|numeric',
            'earningMonth.*' => 'required|integer|between:1,12',
        ]);

        $userId = Auth::id();
        foreach ($request->earningName as $index => $earningName) {
            Earning::create([
                'user_id' => $userId,
                'area_of_earning' => $earningName,
                'amount' => $request->earningAmount[$index],
                'month' => $request->earningMonth[$index],
            ]);
        }
        return redirect()->back()->with('success', 'Earnings saved successfully!');
    }


    public function Editearning($id)
    {
        $editearning = Earning::findOrFail($id);
        return view('EarningExpence.editearning', compact('editearning'));
    }


    public function Updateearning(Request $request, $id) {
        $request->validate([
            'area_of_earning' => 'required',
            'amount' => 'required|numeric',
            'month_number' => 'required|integer|min:1|max:12'
        ]);

        $earning = Earning::findOrFail($id);
        $earning->update([
            'area_of_earning' => $request->input('area_of_earning'),
            'amount' => $request->input('amount'),
            'month_number' => $request->input('month_number'),
        ]);
        return redirect()->route('Earningexpence')->with('success', 'Earnings saved successfully!');
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
