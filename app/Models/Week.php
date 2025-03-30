<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    protected $fillable=["start_date","end_date","week_number","year","top_right","top_left","bottom_right","bottom_left"];

    public function relation1(){
        return $this->hasMany(DailySchedule::class);
    }
}
