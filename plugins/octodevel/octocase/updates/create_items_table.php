<?php namespace OctoDevel\OctoCase\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateItemsTable extends Migration
{

    public function up()
    {
        // Create octodevel_octocase_items table
        if ( !Schema::hasTable('octodevel_octocase_items') )
        {
            Schema::create('octodevel_octocase_items', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('title')->nullable();
                $table->string('slug')->index();
                $table->text('resume')->nullable();
                $table->text('content')->nullable();
                $table->text('content_text')->nullable();
                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->timestamp('published_at')->nullable();
                $table->boolean('published')->default(false);
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        // Drop octodevel_octocase_items table
        if ( Schema::hasTable('octodevel_octocase_items') )
        {
            Schema::drop('octodevel_octocase_items');
        }
    }

}
