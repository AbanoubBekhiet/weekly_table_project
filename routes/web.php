<?php

use App\Http\Controllers\gradeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\mainController;
use App\Http\Controllers\subjectController;
use App\Http\Controllers\weekController;
use App\Http\Middleware\isAdmin;

Route::controller(mainController::class)->group(function(){
    Route::get('/', "home")->name("home");
    Route::get('/teacher_login', "teacher_login")->name("teacher_login");
    Route::get('/admin_login', "admin_login")->name("admin_login");
    Route::post('/teacher_login', "teacher_login_back")->name("teacher_login_back");
    Route::post('/admin_login', "admin_login_back")->name("admin_login_back");
});
Route::controller(mainController::class)->prefix("/admin_dashboard")->middleware(isAdmin::class)->group(function(){
    Route::get('', "admin_dashboard")->name("admin_dashboard");
    Route::get('/create_teacher_account', "create_teacher_account")->name("create_teacher_account");
    Route::post('/create_teacher_account', "create_teacher_account_back")->name("create_teacher_account_back");
    Route::get('/all_teachers', "all_teachers")->name("all_teachers");
});



Route::post('/admin_logout', [mainController::class,"admin_logout"])->name("admin_logout");
Route::post('/teacher_logout', [mainController::class,"teacher_logout"])->name("teacher_logout");



Route::get("admin_dashboard/grades",[gradeController::class,"grades"])->name("grades");
Route::post("admin_dashboard/grades/add_grade",[gradeController::class,"add_grade"])->name("add_grade");


Route::get("admin_dashboard/subjects",[subjectController::class,"subjects"])->name("subjects");
Route::post("admin_dashboard/grades/add_subject",[subjectController::class,"add_subject"])->name("add_subject");


Route::get("admin_dashboard/add_week",[weekController::class,"add_week"])->name("add_week");
Route::post("admin_dashboard/add_week",[weekController::class,"add_week_back"])->name("add_week_back");


Route::get("teacher_dashboard",[mainController::class,"teacher_dashboard"])->name("teacher_dashboard");
Route::get("teacher_dashboard/add_week_content",[weekController::class,"add_week_content"])->name("add_week_content");


Route::post("teacher_dashboard/add_week_content/filter_weeks_by_year",[weekController::class,"filter_weeks_by_year"])->name("filter_weeks_by_year");
Route::post("teacher_dashboard/add_week_content/filter_weeks_by_grade",[weekController::class,"filter_weeks_by_grade"])->name("filter_weeks_by_grade");


Route::post("teacher_dashboard/add_week_content/create_week_grade_subject_part",[weekController::class,"create_week_grade_subject_part"])->name("create_week_grade_subject_part");


Route::get("admin_dashboard/see_all_weeks/admin_all_tables",[weekController::class,"admin_all_tables"])->name("admin_all_tables");
Route::post("admin_dashboard/see_all_weeks/admin_all_tables/filter_tables_by_years", [WeekController::class, "filter_tables_by_years"])
    ->name("filter_tables_by_years");

Route::post("admin_dashboard/see_all_weeks/admin_all_tables/filter_tables_by_weeks", [WeekController::class, "filter_tables_by_weeks"])
    ->name("filter_tables_by_weeks");

Route::post("admin_dashboard/see_all_weeks/admin_all_tables/table_of_content/{week_id}/{grade_id}", [WeekController::class, "table_of_content"])
    ->name("table_of_content");









