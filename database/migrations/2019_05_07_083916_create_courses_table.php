<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('details');
            $table->string('uid')->unique();
            $table->text('slug')->nullable();
            $table->unsignedBigInteger('duration');
            $table->decimal('cost', 16, 2)->default(0)->nullable();
            $table->decimal('discount', 16, 2)->default(0)->nullable();
            $table->boolean('is_live')->default(1);
            $table->string('category_id');
            $table->string('image_url')->nullable();
            $table->string('image_name')->nullable();
            $table->timestamps();

            $table->foreign('category_id')
                    ->references('uid')
                    ->on('categories')
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
        Schema::dropIfExists('courses');
    }
}
