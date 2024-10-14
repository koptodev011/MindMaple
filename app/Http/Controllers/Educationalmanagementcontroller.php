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
            'subject_id.*' => 'required',
            'start_date.*' => 'required|date',
            'end_date.*' => 'required|date|after:start_date.*',
        ]);

        foreach ($request->subject_id as $index => $subject_id) {
            Roadmap::create([
                'subject_id' => $subject_id,
                'start_date' => $request->start_date[$index],
                'end_date' => $request->end_date[$index],
            ]);
        }

        return redirect()->back()->with('success', 'Roadmap created successfully!');
    }


    public function editsection($id){
        $editsection = Edusection::findOrFail($id);
        return view('Educational-Management.editssection', compact('editsection'));
    }


    public function Updatesection(Request $request,$id){
        $request->validate([
            'sectionName' => 'required',
        ]);

        $section = Edusection::findOrFail($id);
        $section->update([
            'edusection' => $request->input('sectionName'),
        ]);
        return redirect()->route('Edusection')->with('success', 'Section saved successfully!');
    }


    public function Deletesection($id){
        $section = Edusection::find($id);
        if ($section) {
            $section->delete();
            return redirect()->route('Edusection')->with('success', 'Section deleted successfully.');
        }
        return redirect()->route('Edusection')->with('error', 'Section not found.');
    }


    public function editsubject($id){

        $subject = Subject::findOrFail($id);
        return view('Educational-Management.editsubject', compact('subject'));
    }

    public function Updatesubject(Request $request,$id){
        $request->validate([
            'subjectName' => 'required',
        ]);

        $subject = Subject::findOrFail($id);
        $subject->update([
            'subject_name' => $request->input('subjectName'),
        ]);
        return redirect()->route('Edusection')->with('success', 'Section saved successfully!');
    }

    public function Deletesubject($id){
        $subject = Subject::find($id);

        if ($subject) {
            $subject->delete();
            return redirect()->route('Edusection')->with('success', 'Section deleted successfully.');
        }
        return redirect()->route('Edusection')->with('error', 'Section not found.');
    }

public function viewroadmap(){
    $roadmap = Roadmap::with('subject')->get();
   
    return view('Educational-Management.viewroadmap',compact('roadmap'));
}



}
