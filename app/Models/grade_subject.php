<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class grade_subject extends Model
{
    protected $table="grade_subject";
    protected $fillable=([
        "grade_id","subject_id"
    ]);
}
