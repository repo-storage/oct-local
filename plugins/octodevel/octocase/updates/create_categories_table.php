<?php namespace OctoDevel\OctoCase\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateCategoriesTable extends Migration
{

    public function up()
    {
        // Create octodevel_octocase_categories table
        if ( !Schema::hasTable('octodevel_octocase_categories') )
        {
            Schema::create('octodevel_octocase_categories', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('name');
                $table->string('slug')->index();
                $table->string('code')->nullable();
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }

        // Create octodevel_octocase_items_categories table
        if ( !Schema::hasTable('octodevel_octocase_items_categories') )
        {
            Schema::create('octodevel_octocase_items_categories', function($table)
            {
                $table->engine = 'InnoDB';
                $table->integer('item_id')->unsigned();
                $table->integer('category_id')->unsigned();
                $table->primary(['item_id', 'category_id']);
            });
        }
    }

    public function down()
    {
        // Drop octodevel_octocase_categories table
        if ( Schema::hasTable('octodevel_octocase_categories') )
        {
            Schema::drop('octodevel_octocase_categories');
        }

        // Drop octodevel_octocase_items_categories table
        if ( Schema::hasTable('octodevel_octocase_items_categories') )
        {
            Schema::drop('octodevel_octocase_items_categories');
        }
    }

}
