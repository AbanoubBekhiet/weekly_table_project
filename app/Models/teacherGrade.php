<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class teacherGrade extends Model
{
    protected $table = "teacher_grade";
    protected $fillable=["grade_id","teacher_id"];
}
