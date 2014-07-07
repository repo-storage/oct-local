<?php namespace Autumn\Pages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddSeoFieldsPagesTable extends Migration
{

    public function up()
    {
        Schema::table('autumn_pages', function($table)
        {
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
        });
    }

    public function down()
    {
        Schema::table('autumn_pages', function($table)
        {
            $table->dropColumn('meta_description');
            $table->dropColumn('meta_keywords');
        });
    }
}
