<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable=["name"];

    public function relation1(){
        return $this->belongsToMany(User::class);
    }
    public function relation2(){
        return $this->hasMany(DailySchedule::class);
    }
    public function relation3(){
        return $this->belongsToMany(Grade::class);
    }
}
