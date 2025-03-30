<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string("assignment")->nullable(); 
            $table->enum("day",["mon","tue","wen","thr","fri"]); 
            $table->unsignedBigInteger("grade_id")->nullable(); 
            $table->unsignedBigInteger("week_id")->nullable(); 
            $table->timestamps();
        });    
    }


    public function down(): void
    {
        //
    }
};
