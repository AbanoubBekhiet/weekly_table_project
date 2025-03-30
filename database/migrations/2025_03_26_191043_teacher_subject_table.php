<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teacher_subject', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("subject_id")->nullable(); 
            $table->unsignedBigInteger("teacher_id")->nullable(); 
            $table->foreign("subject_id")->references("id")->on("subjects")->onDelete("set null");
            $table->foreign("teacher_id")->references("id")->on("users")->onDelete("set null");
            $table->timestamps();
        });    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
