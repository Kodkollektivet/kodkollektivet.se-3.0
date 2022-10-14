<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('position_applications', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('position_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('message');
            $table->text('reply')->nullable();
            $table->boolean('approved')->nullable();

            $table->timestamps();
        });

        Schema::table('position_applications', function($table) {
            $table->foreign('position_id')
                  ->references('id')
                  ->on('positions')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
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
        Schema::dropIfExists('position_applications');
    }
}
