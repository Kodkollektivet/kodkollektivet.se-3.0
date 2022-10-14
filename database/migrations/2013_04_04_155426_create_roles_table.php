<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('name');
            $table->boolean('comment')->default(false);
            $table->boolean('post')->default(false);
            $table->boolean('apply_positions')->default(false);
            $table->boolean('h_comment')->default(false);
            $table->boolean('h_post')->default(false);
            $table->boolean('h_comment_lim')->nullable();
            $table->boolean('h_post_lim')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
