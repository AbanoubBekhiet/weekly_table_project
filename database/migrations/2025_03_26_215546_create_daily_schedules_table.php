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
        Schema::create('daily_schedules', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("week_id")->nullable(); 
            $table->foreign("week_id")->references("id")->on("weeks")->onDelete("set null");
            
            $table->unsignedBigInteger("subject_id")->nullable(); 
            $table->foreign("subject_id")->references("id")->on("subjects")->onDelete("set null");
            
            $table->unsignedBigInteger("grade_id")->nullable(); 
            $table->foreign("grade_id")->references("id")->on("grades")->onDelete("set null");
            
            $table->boolean("completed")->default(false);
            
            // Monday
            $table->text('monday_lesson')->nullable(); // monday_lesson TEXT
            $table->text('monday_books_pages')->nullable(); // monday_books_pages TEXT
            $table->text('monday_homework')->nullable(); // monday_homework TEXT
            $table->date('monday_hw_due_date')->nullable(); // monday_hw_due_date DATE
            $table->text('monday_notes')->nullable(); // monday_homework TEXT

            // Tuesday
            $table->text('tuesday_lesson')->nullable(); // tuesday_lesson TEXT
            $table->text('tuesday_books_pages')->nullable(); // tuesday_books_pages TEXT
            $table->text('tuesday_homework')->nullable(); // tuesday_homework TEXT
            $table->date('tuesday_hw_due_date')->nullable(); // tuesday_hw_due_date DATE
            $table->text('tuesday_notes')->nullable(); // monday_homework TEXT

            // Wednesday
            $table->text('wednesday_lesson')->nullable(); // wednesday_lesson TEXT
            $table->text('wednesday_books_pages')->nullable(); // wednesday_books_pages TEXT
            $table->text('wednesday_homework')->nullable(); // wednesday_homework TEXT
            $table->date('wednesday_hw_due_date')->nullable(); // wednesday_hw_due_date DATE
            $table->text('wednesday_notes')->nullable(); // monday_homework TEXT

            // Thursday
            $table->text('thursday_lesson')->nullable(); // thursday_lesson TEXT
            $table->text('thursday_books_pages')->nullable(); // thursday_books_pages TEXT
            $table->text('thursday_homework')->nullable(); // thursday_homework TEXT
            $table->date('thursday_hw_due_date')->nullable(); // thursday_hw_due_date DATE
            $table->text('thursday_notes')->nullable(); // monday_homework TEXT

            // Friday
            $table->text('friday_lesson')->nullable(); // friday_lesson TEXT
            $table->text('friday_books_pages')->nullable(); // friday_books_pages TEXT
            $table->text('friday_homework')->nullable(); // friday_homework TEXT
            $table->date('friday_hw_due_date')->nullable(); // friday_hw_due_date DATE
            $table->text('friday_notes')->nullable(); // monday_homework TEXT

            $table->timestamps(); // created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP (includes updated_at as well)
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_schedules');
    }
};
