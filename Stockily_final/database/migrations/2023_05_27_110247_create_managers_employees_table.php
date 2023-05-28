<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('managers_employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('managers_id');
            $table->unsignedBigInteger('employees_id');
            $table->timestamps();
            $table->foreign('managers_id')->references('id')->on('users')->where('role', 'manager');
            $table->foreign('employees_id')->references('id')->on('users')->where('role', 'normal_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('managers_employees');
    }
};
