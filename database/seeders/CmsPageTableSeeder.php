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
        
        \DB::table('cms_pages')->insert([
            [
                // Assuming 'id' is auto-increment, you might not need to include it during insertion.
                'slug' => 'cms-library',
                'title' => '{"en":"Library"}',
                'data' => NULL, // Ensure that having NULL here is intentional and acceptable in your application logic.
                'template' => '{"key":"App\\CmsPages\\Templates\\ContentType\\LibraryIndex","name":"content_type.library_index"}',
                'page_type' => 'content_type',
                'parent_id' => NULL, // Same comment as above.
                'like' => NULL, // Ensure NULL is a valid and intentional value.
                'look' => NULL,
                'save' => NULL,
                'created_at' => '2024-07-11 10:02:28',
                'updated_at' => '2024-07-11 10:02:28',
            ],
            [
                // Assuming id is auto-increment, remove it or ensure it's a unique value.
                'slug' => 'cms-article',
                'title' => '{"en":"Article"}',
                'data' => NULL,
                'template' => '{"key":"App\\CmsPages\\Templates\\ContentType\\ArticleIndex","name":"content_type.article_index"}',
                'page_type' => 'content_type',
                'parent_id' => NULL,
                'like' => NULL,
                'look' => NULL,
                'save' => NULL,
                'created_at' => '2024-07-11 10:02:28',
                'updated_at' => '2024-07-11 10:02:28',
            ],
        ]);
        
        
    }
}