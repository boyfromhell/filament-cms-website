<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CmsPageTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cms_pages')->delete();
        
        \DB::table('cms_pages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'slug' => 'cms-library',
                'title' => '{"en":"Library"}',
                'data' => NULL,
                'template' => '{"key":null,"name":null}',
                'page_type' => 'general',
                'parent_id' => NULL,
                'like' => NULL,
                'look' => NULL,
                'save' => NULL,
                'created_at' => '2024-07-11 10:02:28',
                'updated_at' => '2024-07-11 10:02:28',
            ),
        ));
        
        
    }
}