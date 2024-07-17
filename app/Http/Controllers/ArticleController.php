<?php

namespace App\Http\Controllers;

use App\Models\CmsPage;
use App\Models\Seo;
use Illuminate\Http\Request;
use App\Models\CmsPublishedPage;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():array
    {
        $slug='cms-article';
        $slugId=CmsPublishedPage::where('slug', $slug)->first();
        if($slugId){
            $publishedArticles=CmsPublishedPage::where('parent_id', $slugId->id)->where('is_visible', 1)->get();
            // dd($publishedArticles);
            $pageIds = $publishedArticles->pluck('page_id');
            if($publishedArticles->isNotEmpty()){
                // $librarys = CmsPage::where('id', $publishedArticles->page_id)->get();
                $articles = CmsPage::whereIn('id', $pageIds)->get();
                $seoItems=Seo::where('model_type', 'App\Models\CmsPage')->whereIn('model_id', $pageIds)->get();
                $seoMap = $seoItems->keyBy('model_id');

                foreach ($articles as $article) {
                    $article->seo = $seoMap[$article->id] ?? null;
                }
                // dd($librarys);
                return ['articles' => $articles,'success' => 1, 'message' => 'Articles fetched successfully.'];
            } else {
                return ['success' => 0, 'message' => 'There are no published Articles'];
            }
            
        } else {
            return ['success' => 0, 'message' => 'There are no published Articles'];
        }
    }

    public function show(string $slug)
    {
        $pre_slug='cms-article';
        $pre_slugId=CmsPage::where('slug', $pre_slug)->first();
        if (!$pre_slugId) {
            return response()->json(['success' => 0, 'message' => 'Predefined slug not found.'], 404);
        }
        $article=CmsPage::where('parent_id', $pre_slugId->id)
                        ->where('slug', $slug)
                        ->first();
        $seoItems=Seo::where('model_type', 'App\Models\CmsPage')->where('model_id', $article->id)->first();
        $article->seo=$seoItems;
        if (!$article) {
            return response()->json(['success' => 0, 'message' => 'Article not found.'], 404);
        }
        // dd($article);
        return ['article' => $article,'success' => 1, 'message' => 'Article fetched successfully.'];
        
    }
    public function addLike(string $slug, Request $request){
        $pre_slug='cms-article';
        $data = $request->all();
        $pre_slugId=CmsPage::where('slug', $pre_slug)->first();
        // dd($pre_slugId);
        // dd($slug, $data['like']);
        $article = CmsPage::where('parent_id', $pre_slugId->id)
                            ->where('slug', $slug)
                            ->first();
        // dd($article);
        // ->update(['piece_title' => $data->title]);
        $article->like = $data['like'];
        $article->save();
        return $article;

    }
}
