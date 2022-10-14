<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStageTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stage_tasks', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->boolean('done')->nullable();
            $table->integer('stage_id')->unsigned();

            $table->timestamps();
        });

        Schema::table('stage_tasks', function($table) {
            $table->foreign('stage_id')
                  ->references('id')
                  ->on('project_stages')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stage_tasks');
    }
}
