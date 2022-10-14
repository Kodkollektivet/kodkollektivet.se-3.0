<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('name');

            $permissions = array(
                'remove_posts', 'remove_events', 'remove_projects', 'remove_docs',
                'create_posts', 'create_events', 'create_projects', 'create_docs',
                'edit_posts', 'edit_events', 'edit_projects', 'edit_docs',      
                'edit_users', 'edit_social', 'close_accounts', 'remove_userdata',
                'set_roles', 'set_positions', 'ban', 'application_decide', 'open'
            );

            /**
             * close_accounts:  deactivate; posts and personal information remain
             * remove_userdata: deactivate and remove user data
             * ban:             change role to 'Purgatory'
             */

            foreach ($permissions as $permission) {
                $table->boolean($permission)->default(false);
            }

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('positions');
    }
}
