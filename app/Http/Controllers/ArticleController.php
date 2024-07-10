<?php

namespace App\Http\Controllers;

use App\Models\CmsPage;
use App\Models\CmsPublishedPage;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():array
    {
        // $slug='cms-article';
        // $articleID = CmsPage::where('slug', $slug)->first();
        // if($articleID){
        //     $articles=CmsPage::where('parent_id', $articleID->id)->get();
        //     // dd($articles);
        //     return ['articles' => $articles,'success' => 1, 'message' => 'User updated successfully.'];
        //     // return $articles;
            
        // }

        $slug='cms-article';
        $slugId=CmsPublishedPage::where('slug', $slug)->first();
        if($slugId){
            $publishedArticles=CmsPublishedPage::where('parent_id', $slugId->id)->where('is_visible', 1)->get();
            // dd($publishedArticles);
            $pageIds = $publishedArticles->pluck('page_id');
            if($publishedArticles->isNotEmpty()){
                // $librarys = CmsPage::where('id', $publishedArticles->page_id)->get();
                $articles = CmsPage::whereIn('id', $pageIds)->get();
                // dd($librarys);
                return ['articles' => $articles,'success' => 1, 'message' => 'Articles fetched successfully.'];
            } else {
                return ['success' => 0, 'message' => 'There are no published Articles'];
            }
            
        } else {
            return ['success' => 0, 'message' => 'There are no published Articles'];
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
