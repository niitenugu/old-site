<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScholarshipAttendeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scholarship_attendees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('scholarship_id');
            $table->string('city')->nullable();
            $table->datetime('checked_in_at')->nullable();
            $table->string('preferred_exam_time')->nullable();
            $table->string('school_level')->nullable();
            $table->string('invitation_code')->nullable();
            $table->string('uid')->unique();
            $table->string('gender')->nullable();
            $table->timestamps();

            $table->foreign('scholarship_id')
                    ->references('uid')
                    ->on('scholarships')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scholarship_attendees');
    }
}
