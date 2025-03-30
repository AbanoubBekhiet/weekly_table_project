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
        ],
        [
            "name.required"=>"يجب إدخال المادة الدراسية",
            "name.unique"=>"المادة الدراسية موجودة بالفعل",
        ]);


        Subject::create([
            "name"=>$request->name
        ]);

        return redirect()->back()->with("message","تم إضافة  المادة الدراسية بنجاح");
    }
}
