<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category')->nullable();
            $table->string('name')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('status')->default(6);
            $table->integer('budget_id')->nullable();
            $table->integer('duration')->nullable();
            $table->text('description')->nullable();
            $table->text('skills')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
