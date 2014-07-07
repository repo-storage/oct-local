<?php namespace Autumn\Pages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreatePagesTable extends Migration
{

    public function up()
    {
        Schema::create('autumn_pages', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->string('title')->nullable();
            $table->string('slug')->index();
            $table->text('content')->nullable();
            $table->boolean('active')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('autumn_pages');
    }

}
