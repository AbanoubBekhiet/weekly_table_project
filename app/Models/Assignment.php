<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table="assignments";
    protected $fillable=["assignment","day","grade_id","week_id"]; 
}
