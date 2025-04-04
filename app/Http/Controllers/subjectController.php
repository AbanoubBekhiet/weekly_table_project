<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class subjectController extends Controller
{
    public function subjects(){
        $subjects=Subject::all();
        return view("subjects",compact("subjects"));
    }
    public function add_subject(Request $request){
        $validated_data=$request->validate([
            "name"=>"required|unique:subjects,name|string",
        ]);


        Subject::create([
            "name"=>$request->name
        ]);

        return redirect()->back()->with("message","subject was added successfully");
    }
}
