<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
class historycontroller extends Controller
{
    public function viewhistory(){
        $userId = Auth::id();
        $history = Payment::where('user_id',$userId)->get();
        return view('History.history',compact('history'));
    }
}
