<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailySchedule extends Model
{
   protected $table="daily_schedules";
    
   public function role1(){
      $this->belongsTo(Subject::class);
   }
   public function role2(){
      $this->belongsTo(Week::class);
   }
   public function role3(){
      $this->belongsTo(Grade::class);
   }


   protected $fillable=[
      "week_id",
      "grade_id",
      "subject_id",
      "monday_lesson",
      "monday_books_pages",
      "monday_homework",
      "monday_hw_due_date",
      "monday_notes",
      "tuesday_lesson",
      "tuesday_books_pages",
      "tuesday_homework",
      "tuesday_hw_due_date",
      "tuesday_notes",
      "wednesday_lesson",
      "wednesday_books_pages",
      "wednesday_homework",
      "wednesday_hw_due_date",
      "wednesday_notes",
      "thursday_lesson",
      "thursday_books_pages",
      "thursday_homework",
      "thursday_hw_due_date",
      "thursday_notes",
      "friday_lesson",
      "friday_books_pages",
      "friday_homework",
      "friday_hw_due_date",
      "friday_notes",
      "completed",
   ];
   
}
