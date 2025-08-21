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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->integer('term');
            $table->foreignId('school_class_id')->constrained('school_classes')->onDelete('cascade');
            $table->foreignId('class_arm_id')->constrained()->onDelete('cascade');


            // Assessment scores
            $table->integer('ca')->nullable()->default(null);
            $table->integer('ca2')->nullable()->default(null);
            $table->integer('ca3')->nullable()->default(null);
            $table->integer('ca4')->nullable()->default(null);
            $table->integer('exam')->nullable()->default(null);
            $table->integer('total')->nullable()->default(null);


            // Grading
            $table->string('grade', 2)->nullable()->default(null);

            // Class statistics
            $table->integer('class_lowest_score')->default(0);
            $table->integer('class_highest_score')->default(0);
            $table->decimal('subject_avg_score', 5, 2)->default(0);
            $table->integer('position')->default(0);
            $table->timestamps();

            // Unique constraint to prevent duplicate entries
            $table->unique(['student_id', 'subject_id', 'term']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
