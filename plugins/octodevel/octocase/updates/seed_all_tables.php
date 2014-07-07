<?php namespace OctoDevel\OctoCase\Updates;

use OctoDevel\OctoCase\Models\Category;
use October\Rain\Database\Updates\Seeder;

class SeedAllTables extends Seeder
{

    public function run()
    {
        //
        // @todo
        //
        // Add a Welcome item or something
        //

        Category::create([
            'name' => 'Uncategorized'
        ]);
    }

}
