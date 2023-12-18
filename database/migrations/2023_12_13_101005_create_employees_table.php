<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('employee_id');
            $table->string('employee_name');
            $table->string('employee_position');
            $table->string('employee_Email')->nullable();
            $table->string('employee_ContactNumber')->nullable();
            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')->references('store_id')->on('stores')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
