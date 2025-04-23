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
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 222);
            $table->string('email', 222)->unique();
            $table->enum('gender', ['boy', 'girl']);
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->date('birthday')->nullable();
            $table->string('address', 222)->nullable();
            $table->integer('age')->nullable();
            $table->string('school_level', 222)->nullable();
            $table->date('date_joined')->nullable();
            $table->date('date_detached')->nullable();
            $table->string('urgent_contact', 222)->nullable();
            $table->string('school', 222)->nullable();
            $table->string('health_condition', 222)->nullable();
            $table->string('disease_type', 222)->nullable();
            $table->string('profile_img', 222)->nullable();
            $table->foreignId('room_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps(); 
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
