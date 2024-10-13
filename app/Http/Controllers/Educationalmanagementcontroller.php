<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Earning;
use App\Models\Expence;
use App\Models\Payment;
use App\Models\Edusection;
use App\Models\Roadmap;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class Educationalmanagementcontroller extends Controller
{
    public function Edusection(){
        $userId = Auth::id();
        $edusections=Edusection::where('user_id',$userId)->get();
        return view('Educational-Management.edusection',compact('edusections'));
    }

    public function Addedusection(Request $request){
        $userId = Auth::id();
        $request->validate([
            'edusectionname' => 'required|string|max:255'
        ]);

        $edusection=new Edusection();
        $edusection->edusection=$request->edusectionname;
        $edusection->user_id=$userId;
        $edusection->save();
        return redirect()->back()->with('success', 'Section saved successfully!');
    }


    public function subjects($id) {
        $subjects = Subject::where('section_id', $id)->get();

        return view('Educational-Management.Subjects', compact('subjects', 'id')); // Pass id if needed
    }

    public function Addedusubject(Request $request, $id) {
        $userId = Auth::id();
        $request->validate([
            'edusubjectname' => 'required|string|max:255'
        ]);

        $subjects = new Subject();
        $subjects->subject_name = $request->edusubjectname; // This should match your input name
        $subjects->section_id = $id; // Use the ID as needed
        $subjects->save();

        return redirect()->back()->with('success', 'Section saved successfully!');
    }

    public function createRoadmap(Request $request)
    {
        $request->validate([
            'roadmap_name.*' => 'required|exists:subjects,id',
            'start_date.*' => 'required|date',
            'end_date.*' => 'required|date|after:start_date.*',
        ]);


        $userId = Auth::id();

        foreach ($request->roadmap_name as $index => $roadmap_name) {
            Roadmap::create([
                'subject_id' => $roadmap_name, // Use the value directly from the request
                'start_date' => $request->start_date[$index],
                'end_date' => $request->end_date[$index],
            ]);
        }

        return redirect()->back()->with('success', 'Earnings saved successfully!');
    }




}
