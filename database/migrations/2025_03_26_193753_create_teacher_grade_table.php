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
        Schema::create('teacher_grade', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("grade_id")->nullable(); 
            $table->unsignedBigInteger("teacher_id")->nullable(); 
            $table->foreign("grade_id")->references("id")->on("grades")->onDelete("set null");
            $table->foreign("teacher_id")->references("id")->on("users")->onDelete("set null");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_grade');
    }
};
