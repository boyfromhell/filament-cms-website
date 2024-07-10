<?php

namespace App\Http\Controllers;

use App\Models\CmsPage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():array
    {
        $slug='cms-article';
        $articleID = CmsPage::where('slug', $slug)->first();
        if($articleID){
            $articles=CmsPage::where('parent_id', $articleID->id)->get();
            // dd($articles);
            return ['articles' => $articles,'success' => 1, 'message' => 'User updated successfully.'];
            // return $articles;
            
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(CmsPage $page): LibraryResource
    // {
    //     return new LibraryResource($page);
    // }
}
