<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Week;
use App\Models\Grade;
use App\Models\Assignment;
use App\Models\DailySchedule;
use Illuminate\Console\Scheduling\ScheduleWorkCommand;

class weekController extends Controller
{
    public function add_week(){
        return view("add_week");
    }


    public function add_week_back(Request $request){
    $currentYear = Carbon::now()->year;

    $data = $request->validate([
        "start_date" => "required|date",
        "end_date" => "required|date",
        "week_number" => [
            "required",
            "string",
            Rule::unique("weeks")->where(function ($query) use ($currentYear) {
                return $query->where("year", $currentYear);
            }),
        ],
        "top_right"=>"string|required",
        "top_left"=>"string|required",
        "bottom_right"=>"string|required",
        "bottom_left"=>"string|required",
    ]);

    $data["year"] = $currentYear;

    Week::create($data);

    return back()->with("message", "week was added successfully");

    }




    public function add_week_content(){
        $years = Week::select("year")->distinct()->get();
        return view("add_week_content",compact("years"));
    }



    public function filter_weeks_by_year(Request $request){
        $year=$request->validate([
            "year"=>"integer|required",
        ]);

        $weeks=Week::get()->where("year","=",$request->year);

        $grades= DB::table("grades")
            ->join("teacher_grade", "grades.id", "=", "teacher_grade.grade_id")
            ->where("teacher_grade.teacher_id", Auth::id())
            ->select("grades.id as grade_id", "grades.name as grade_name")
            ->get();

    return response()->json(compact(["weeks","grades"]));
    }





    public function filter_weeks_by_grade(Request $request){

        // $subjects = DB::table("grade_subject")
        // ->join("subjects", "grade_subject.subject_id", "=", "subjects.id")
        // ->join("teacher_subject", function ($join) use ($request) {
        //     $join->on("teacher_subject.subject_id", "=", "grade_subject.subject_id")
        //          ->where("teacher_subject.teacher_id", Auth::id());
        // })
        // ->where("grade_subject.grade_id", $request->grade)
        // ->select("subjects.id as subject_id", "subjects.name as subject_name")
        // ->distinct()
        // ->get();



        $subjects_not_checked = DB::table("grade_subject")
        ->join("subjects", "grade_subject.subject_id", "=", "subjects.id")
        ->join("teacher_subject", function ($join) use ($request) {
            $join->on("teacher_subject.subject_id", "=", "grade_subject.subject_id")
                 ->where("teacher_subject.teacher_id", Auth::id());
        })
        ->where("grade_subject.grade_id", $request->grade)
        ->select("subjects.id as subject_id", "subjects.name as subject_name")
        ->distinct()
        ->get();



        $existingSubjects = DailySchedule::where("week_id", $request->week)
        ->where("grade_id", $request->grade)
        ->pluck("subject_id") 
        ->toArray();
    
    $subjects = collect($subjects_not_checked)->reject(function ($sub) use ($existingSubjects) {
        return in_array($sub->subject_id, $existingSubjects); 
    });
    



    return response()->json(compact("subjects"));
    }





    public function create_week_grade_subject_part(Request $request){
        $data=$request->validate([
            "week" => "integer|required",
            "grade" => "integer|required",
            "subject" => "integer|required",
            "monday_lesson" => "string|nullable",
            "monday_books_pages" => "string|nullable",
            "monday_homework" => "string|nullable",
            "monday_hw_due_date" => "date|nullable",
            "monday_notes" => "string|nullable",
            "tuesday_lesson" => "string|nullable",
            "tuesday_books_pages" => "string|nullable",
            "tuesday_homework" => "string|nullable",
            "tuesday_hw_due_date" => "date|nullable",
            "tuesday_notes" => "string|nullable",
            "wednesday_lesson" => "string|nullable",
            "wednesday_books_pages" => "string|nullable",
            "wednesday_homework" => "string|nullable",
            "wednesday_hw_due_date" => "date|nullable",
            "wednesday_notes" => "string|nullable",
            "thursday_lesson" => "string|nullable",
            "thursday_books_pages" => "string|nullable",
            "thursday_homework" => "string|nullable",
            "thursday_hw_due_date" => "date|nullable",
            "thursday_notes" => "string|nullable",
            "friday_lesson" => "string|nullable",
            "friday_books_pages" => "string|nullable",
            "friday_homework" => "string|nullable",
            "friday_hw_due_date" => "date|nullable",
            "friday_notes" => "string|nullable",
            "assignment" => "string|nullable",
            "day" => "string|nullable",
        ]);
        DailySchedule::create([
            "week_id" => $request->week,
            "grade_id" => $request->grade,
            "subject_id" => $request->subject,
            "monday_lesson" =>$request->monday_lesson ,
            "monday_books_pages" => $request->monday_books_pages ,
            "monday_homework" => $request->monday_homework ,
            "monday_hw_due_date" => $request->monday_hw_due_date ,
            "monday_notes" => $request->monday_notes ,
            "tuesday_lesson" => $request->tuesday_lesson ,
            "tuesday_books_pages" => $request->tuesday_books_pages ,
            "tuesday_homework" => $request->tuesday_homework ,
            "tuesday_hw_due_date" => $request->tuesday_hw_due_date ,
            "tuesday_notes" => $request->tuesday_notes ,
            "wednesday_lesson" => $request->wednesday_lesson ,
            "wednesday_books_pages" => $request->wednesday_books_pages ,
            "wednesday_homework" => $request->wednesday_homework ,
            "wednesday_hw_due_date" => $request->wednesday_hw_due_date ,
            "wednesday_notes" => $request->wednesday_notes ,
            "thursday_lesson" => $request->thursday_lesson ,
            "thursday_books_pages" => $request->thursday_books_pages ,
            "thursday_homework" => $request->thursday_homework ,
            "thursday_hw_due_date" => $request->thursday_hw_due_date ,
            "thursday_notes" => $request->thursday_notes ,
            "friday_lesson" => $request->friday_lesson ,
            "friday_books_pages" => $request->friday_books_pages ,
            "friday_homework" => $request->friday_homework ,
            "friday_hw_due_date" => $request->friday_hw_due_date ,
            "friday_notes" => $request->friday_notes ,
            "completed" => 1 ,
        ]);

        Assignment::create([
            "week_id" => $request->week,
            "grade_id" => $request->grade,
            "assignment" => $request->assignment,
            "day" => $request->day,
        ]);

        return back()->with("message"," content was added successfully");
    }



    public function admin_all_tables(){
        $years=Week::select("year")->distinct()->get();
        return view("admin_all_tables",compact("years"));
    }


    public function filter_tables_by_years(Request $request){
        $year=$request->validate([
            "year"=>"integer|required"
        ]);
        $weeks=Week::get()->where("year",$request->year);
        return response()->json($weeks);
    }

    public function filter_tables_by_weeks(){
        $grads=Grade::all();
        return response()->json($grads);
    }



    public function table_of_content($week_id, $grade_id)
    {
        $week = DB::table('weeks')->where('id', $week_id)->first();
        $gradeName = DB::table('grades')->where('id', $grade_id)->value('name');
        $assignments=Assignment::get()->where("grade_id",$grade_id)
        ->where("week_id",$week_id)->groupBy("day");
        $subjects = DB::table('grade_subject')
            ->join('subjects', 'grade_subject.subject_id', '=', 'subjects.id')
            ->where('grade_subject.grade_id', $grade_id)
            ->select('subjects.id as subject_id', 'subjects.name as subject_name')
            ->get();
    
        $tableOfContent = [];
    
        foreach ($subjects as $subject) {
            $scheduleData = DB::table('daily_schedules')
                ->where('week_id', $week_id)
                ->where('grade_id', $grade_id)
                ->where('subject_id', $subject->subject_id)
                ->select(
                    'monday_lesson', 'monday_books_pages', 'monday_homework', 'monday_hw_due_date', 'monday_notes',
                    'tuesday_lesson', 'tuesday_books_pages', 'tuesday_homework', 'tuesday_hw_due_date', 'tuesday_notes',
                    'wednesday_lesson', 'wednesday_books_pages', 'wednesday_homework', 'wednesday_hw_due_date', 'wednesday_notes',
                    'thursday_lesson', 'thursday_books_pages', 'thursday_homework', 'thursday_hw_due_date', 'thursday_notes',
                    'friday_lesson', 'friday_books_pages', 'friday_homework', 'friday_hw_due_date', 'friday_notes'
                )
                ->get()
                ->toArray();
    
            $tableOfContent[$subject->subject_name] = $scheduleData;
        }
        $grade_id = (int) $grade_id;
    
        return view('table', compact('week', 'tableOfContent','gradeName','grade_id','assignments'));
    }
    







    public function filter_created_schedule_content(Request $request){

        $subjects =DB::table("subjects")
        ->join("daily_schedules","subjects.id","daily_schedules.subject_id")
        ->where("daily_schedules.week_id",$request->week)
        ->where("daily_schedules.grade_id",$request->grade)
        ->get();
    return response()->json(compact("subjects"));
    }





        public function getSubjectContent(Request $request)
        {
            $subject = DB::table('daily_schedules')
                ->where('subject_id', $request->subject_id)
                ->where('week_id', $request->week_id)
                ->where('grade_id', $request->grade_id)
                ->first();

            return $subject;
        }




    public function teacher_alter_week_content(){
        $years=Week::select("year")->distinct()->get();
        return view("teacher_alter_week_content",compact("years"));
    }

    public function teacher_update_week_content(Request $request){
        $data=$request->validate([
            "week" => "integer|required",
            "grade" => "integer|required",
            "subject" => "integer|required",
            "monday_lesson" => "string|nullable",
            "monday_books_pages" => "string|nullable",
            "monday_homework" => "string|nullable",
            "monday_hw_due_date" => "date|nullable",
            "monday_notes" => "string|nullable",
            "tuesday_lesson" => "string|nullable",
            "tuesday_books_pages" => "string|nullable",
            "tuesday_homework" => "string|nullable",
            "tuesday_hw_due_date" => "date|nullable",
            "tuesday_notes" => "string|nullable",
            "wednesday_lesson" => "string|nullable",
            "wednesday_books_pages" => "string|nullable",
            "wednesday_homework" => "string|nullable",
            "wednesday_hw_due_date" => "date|nullable",
            "wednesday_notes" => "string|nullable",
            "thursday_lesson" => "string|nullable",
            "thursday_books_pages" => "string|nullable",
            "thursday_homework" => "string|nullable",
            "thursday_hw_due_date" => "date|nullable",
            "thursday_notes" => "string|nullable",
            "friday_lesson" => "string|nullable",
            "friday_books_pages" => "string|nullable",
            "friday_homework" => "string|nullable",
            "friday_hw_due_date" => "date|nullable",
            "friday_notes" => "string|nullable",
            "assignment" => "string|nullable",
            "day" => "string|nullable",
        ]);

        $schedule = DailySchedule::where("week_id", $request->week)
        ->where("grade_id", $request->grade)
        ->where("subject_id", $request->subject)
        ->first();

    if (!$schedule) {
        return redirect()->back()->with("error", "Schedule not found.");
    }

    $schedule->update($data);


        return to_route("teacher_dashboard")->with("message","daily schedule subject has been updated");
    }


    

    
}
