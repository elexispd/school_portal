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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('from_class_id')->constrained('school_classes')->onDelete('cascade');
            $table->foreignId('from_class_arm_id')->constrained('class_arms')->nDelete('cascade');
            $table->foreignId('to_class_id')->constrained('school_classes')->onDelete('cascade');
            $table->foreignId('to_class_arm_id')->constrained('class_arms')->nDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
