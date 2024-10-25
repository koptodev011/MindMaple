<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Expence;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
class Pdfcontroller extends Controller
{


    public function generatePDF()
    {
        $userId = Auth::id();
        $currentMonth = now()->format('m');
        $expenses = Expence::where('user_id', $userId)->where('month', $currentMonth)->get();
        $totalExpense = $expenses->sum('amount');
        $remainingamount =Payment::where('user_id',$userId)->first();
        $pdf = PDF::loadView('Pdfs.printexpence', compact('expenses', 'totalExpense','remainingamount'));
        return $pdf->download('Expence.pdf');
    }


}
