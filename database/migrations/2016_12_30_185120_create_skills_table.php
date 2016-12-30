<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('color');
            $table->timestamps();
        });

        Schema::create('experience_skill', function(Blueprint $table) {
            $table->unsignedInteger('experience_id');
            $table->unsignedInteger('skill_id');

            $table->unsignedSmallInteger('percentage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experience_skill');
        Schema::dropIfExists('skills');
    }
}
