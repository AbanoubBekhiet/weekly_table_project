<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class teacherSubject extends Model
{
    protected $table = "teacher_subject";
    protected $fillable=["subject_id","teacher_id"];

}
