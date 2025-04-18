<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\teacherGrade;
use App\Models\teacherSubject;
use App\Imports\TeacherImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class mainController extends Controller
{
    public function home(){
        return view("home");
    }
    public function admin_login(){
        return view("admin_login");
    }


    public function admin_login_back(Request $request)
    {
        $validated_data = $request->validate([
            "email" => "required|email",
            "password" => "required|string",
        ]);
    
        $remember = $request->has('remember');
    
        if (Auth::guard('admins')->attempt($validated_data, $remember)) {
            $request->session()->regenerate();   
            Auth::guard('web')->logout();
            return to_route('admin_dashboard')->with('message', 'you are logged in successfully');
        }
    
        return redirect()->back()
            ->withInput($request->only('email'))
            ->with('message', 'wrong email or password');
    }


    public function teacher_login(){
        return view("teacher_login");
    }

    public function teacher_login_back(Request $request){
        $validated_data = $request->validate([
            "email" => "required|email",
            "password" => "required|string",
        ]);
    
        $remember = $request->has('remember');
    
        if (Auth::attempt($validated_data, $remember)) {
            $request->session()->regenerate();
            return to_route('teacher_dashboard')->with('message', 'you are logged in successfully');
        }
    
        return redirect()->back()
            ->with('message', 'wrong email or password');
    
            
       }


       public function admin_dashboard(){
            return view("admin_dashboard");
       }

    
       
    public function create_teacher_account(){
        $subjects=Subject::all();
        $grades=Grade::all();

        return view("create_teacher_account",compact(["subjects","grades"]));
    } 

    public function create_teacher_account_back(Request $request){

        $validated_data = $request->validate([
            "email" => "required|email|unique:users,email",
            "password" => "required|string",
            "name" => "required|string",
        ]);
        $user=User::create([
            "name"=>$request->name,
            "password"=>Hash::make($request->password),
            "email"=>$request->email,
            "password_not_hashed"=>$request->password,
        ]);
        foreach($request->subjects as $sub){
            teacherSubject::create([
                "subject_id"=>$sub,
                "teacher_id"=>$user->id,
            ]);  
        }
        foreach($request->grades as $grade){
            teacherGrade::create([
                "grade_id"=>$grade,
                "teacher_id"=>$user->id,
            ]);
        }
            return to_route("create_teacher_account")->with("message","teacher was added successfully");

    }

    public function admin_logout(Request $request){
        Auth::guard('admins')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return to_route("home")->with('message', 'you logged out successfully');
    }

    public function teacher_logout(Request $request){
        Auth::logout(); 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return to_route("home")->with('message', 'you logged out successfully');

    }


    public function all_teachers(){
        $teachers = DB::table("users")
    ->leftJoin("teacher_grade", "users.id", "=", "teacher_grade.teacher_id")
    ->leftJoin("grades", "teacher_grade.grade_id", "=", "grades.id") // Join grades table
    ->leftJoin("teacher_subject", "users.id", "=", "teacher_subject.teacher_id")
    ->leftJoin("subjects", "teacher_subject.subject_id", "=", "subjects.id") // Join subjects table
    ->select(
        "users.id",
        "users.name",
        "users.email",
        "users.password_not_hashed",
        DB::raw("GROUP_CONCAT(DISTINCT grades.name) as grades"),  // Get grade names instead of IDs
        DB::raw("GROUP_CONCAT(DISTINCT subjects.name) as subjects") // Get subject names instead of IDs
    )
    ->groupBy("users.id", "users.name", "users.email", "users.password_not_hashed")
    ->get();

    $subjects=Subject::all();
    $grades=Grade::all();

        foreach ($teachers as $teacher) {
            $teacher->grades = $teacher->grades ? explode(",", $teacher->grades) : [];
            $teacher->subjects = $teacher->subjects ? explode(",", $teacher->subjects) : [];
        }

       

        return view("all_teachers",compact(["teachers","subjects","grades"]));
    }
    



    public function teacher_dashboard(){
        return view("teacher_dashboard");
    }

    public function import_teachers(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);


        try {
            Excel::import(new TeacherImport, $request->file('file'));
            return back()->with('message', 'Teachers imported successfully.');
        } catch (ValidationException $e) {
            $failures = $e->failures();
            return back()->with([
                'importErrors' => $failures
            ]);
        }

    }

    public function update_teacher(Request $request,$id){

        $teacherId = $id;

        $request->validate([
            'subjects' => [
                'array',
                function($attribute, $value, $fail) use ($teacherId) {
                    foreach ($value as $subjectId) {
                        $exists = DB::table('teacher_subject')->where('teacher_id', $teacherId)->where('subject_id', $subjectId)->exists();
                        if ($exists) {
                            $fail("The teacher has this subject already ");
                        }
                    }
                }
            ],
            'grades' => [
                'array',
                function($attribute, $value, $fail) use ($teacherId) {
                    foreach ($value as $gradeId) {
                        $exists = DB::table('teacher_grade')->where('teacher_id', $teacherId)->where('grade_id', $gradeId)->exists();
                        if ($exists) {
                            $fail("The teacher has this grade already ");
                        }
                    }
                }
            ],
        ]);
        $user=User::find($id);

        if($request->subjects){
            foreach($request->subjects as $sub){
                teacherSubject::create([
                    "subject_id"=>$sub,
                    "teacher_id"=>$user->id,
                ]);  
            }
        }

        if($request->grades){
            foreach($request->grades as $grade){
                teacherGrade::create([
                    "grade_id"=>$grade,
                    "teacher_id"=>$user->id,
                ]);
            }
        }
        
        return redirect()->back()->with('message', 'Teacher updated successfully.');

    }



    public function delete_teacher($id){

        $user=User::find($id);
        $user->delete();
        return redirect()->back()->with('message', 'Teacher deleted successfully.');

    }
    
}
