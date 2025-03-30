<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable=['name','password','email'];
    protected $table = 'admins'; 
    protected $guarded = []; 

    protected $primaryKey = 'id';

    public $timestamps = true;
}
