<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Grade;
use App\Models\grade_subject;
use App\Models\Subject;

class gradeController extends Controller
{
    public function grades(){
        $grades = DB::table("grades")
        ->leftJoin("grade_subject", "grades.id", "=", "grade_subject.grade_id")
        ->leftJoin("subjects", "grade_subject.subject_id", "=", "subjects.id")
        ->select(
            "grades.id as grade_id",
            "grades.name as grade_name",
            "subjects.name as subject_name"
        )
        ->get()
        ->groupBy("grade_id")
        ->map(function ($items) {
            return [
                "grade_id" => $items->first()->grade_id,
                "grade_name" => $items->first()->grade_name,
                "subjects" => $items->pluck("subject_name")->toArray()
            ];
        })->values();
    
    

        $subjects=Subject::all();
        return view("grades",compact(["grades","subjects"]));
    }
    public function add_grade(Request $request){
        $validated_data=$request->validate([
            "name"=>"required|unique:grades,name|string",
        ]);

        $grade=Grade::create([
            "name"=>$request->name
        ]);

        foreach($request->subjects as $sub){
            grade_subject::create([
                "subject_id"=>$sub,
                "grade_id"=>$grade->id,
                "teacher_id"=>Auth::id(),
            ]);  
        }



        return redirect()->back()->with("message","grade was added successfully");
    }
}
