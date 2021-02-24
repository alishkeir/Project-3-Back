<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("first_name");
            $table->string("last_name");
            $table->string("email");
            $table->string("password");
            $table->string("phone_number");
            $table->string("whatsapp_number");
            $table->string("nationality");
            $table->string("image");
            $table->string("status");
            $table->unsignedBigInteger('school_id');
            $table->foreign('school_id')->references('id')->on('schools');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
