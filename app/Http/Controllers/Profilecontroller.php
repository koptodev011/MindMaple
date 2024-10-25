<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class Profilecontroller extends Controller
{
    public function getprofiledata(){
        $user = Auth::user();
        return view('Profile.profile',compact('user'));
    }


    public function Updateprofile(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);

        return redirect()->route('getprofiledata')->with('success', 'Profile saved successfully!');
    }


    public function Updatepassword(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'User not authenticated.']);
        }

        if ($user->email !== $request->email) {
            return redirect()->back()->withErrors(['email' => 'The provided email does not match our records.']);
        }

        // Use the update method to change the password
        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->route('login')->with('status', 'Password changed successfully!');
    }



}
