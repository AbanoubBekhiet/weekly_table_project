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
        Schema::create('grade_subject', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("grade_id")->nullable(); 
            $table->unsignedBigInteger("subject_id")->nullable(); 
            $table->foreign("grade_id")->references("id")->on("grades")->onDelete("set null");
            $table->foreign("subject_id")->references("id")->on("subjects")->onDelete("set null");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade_subject_relation');
    }
};
