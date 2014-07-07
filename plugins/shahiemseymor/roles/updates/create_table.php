<?php namespace ShahiemSeymor\Roles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateTable extends Migration
{

    public function up()
    {
       Schema::create('shahiemseymor_roles', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Creates the assigned_roles (Many-to-Many relation) table
        Schema::create('shahiemseymor_assigned_roles', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();
        });

        // Creates the permissions table
        Schema::create('shahiemseymor_permissions', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('display_name')->nullable();
            $table->timestamps();
        });

        // Creates the permission_role (Many-to-Many relation) table
        Schema::create('shahiemseymor_permission_role', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
        });
    }

    public function down()
    {
        Schema::drop('shahiemseymor_assigned_roles');
        Schema::drop('shahiemseymor_permission_role');
        Schema::drop('shahiemseymor_roles');
        Schema::drop('shahiemseymor_permissions');
    }

}
