<?php

namespace App\Http\Controllers;

use App\Http\Resources\LibraryResource;
use App\Models\CmsPage;
use App\Models\CmsPublishedPage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index1(): AnonymousResourceCollection
    {
        // dd('library');
        return LibraryResource::collection(CmsPage::all());
    }

    public function index():array
    {
        // $presentation = $page
        //     // ->presentations()
        //     ->where('slug', $slug)
        //     ->firstOrFail();
        // dd('hh');
        $slug='cms-library';
        $slugId=CmsPublishedPage::where('slug', $slug)->first();
        if($slugId){
            $publishedLibrarys=CmsPublishedPage::where('parent_id', $slugId->id)->where('is_visible', 1)->get();
            // dd($publishedLibrarys);
            $pageIds = $publishedLibrarys->pluck('page_id');
            if($publishedLibrarys->isNotEmpty()){
                // $librarys = CmsPage::where('id', $publishedLibrarys->page_id)->get();
                $librarys = CmsPage::whereIn('id', $pageIds)->get();
                // dd($librarys);
                return ['librarys' => $librarys,'success' => 1, 'message' => 'Library fetched successfully.'];
            } else {
                return ['success' => 0, 'message' => 'There are no published library'];
            }
            
        } else {
            return ['success' => 0, 'message' => 'There are no published library'];
        }
        // dd($slugId);
        
        // $cmsPublishedPage=CmsPublishedPage::all();
        // // dd($libraryID->id);
        // if($libraryID){
            
        //     $publisedLibrary=CmsPage::where('id', $cmsPublishedPage->page_id)
        //                             ->where('is_visible', 1)
        //                             ->get();                        
        //     if($publisedLibrary){
        //         dd('ok');
        //         return ['librarys' => $librarys,'success' => 1, 'message' => 'Library fetched successfully.'];
        //     } else {
        //         return ['success' => 0, 'message' => 'There are no published library'];
        //     }
        //     // dd($librarys);
            
        //     // return $librarys;
            
        // }
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $slug): JsonResponse
    // {
    //     $pre_slug='cms-library';
    //     $pre_slugId=CmsPage::where('slug', $pre_slug)->first();
    //     if (!$pre_slugId) {
    //         return response()->json(['success' => 0, 'message' => 'Predefined slug not found.'], 404);
    //     }
    //     $library=CmsPage::where('parent_id', $pre_slugId->id)->first();
    //     if (!$library) {
    //         return response()->json(['success' => 0, 'message' => 'Library not found.'], 404);
    //     }
    //     return response()->json([
    //         'library' => $library,
    //         'success' => 1, 
    //         'message' => 'Library fetched successfully.'
    //     ]);
    //     // return ['library' => $library,'success' => 1, 'message' => 'Library fetched successfully.'];
    //     // dd($library);
    // }

    public function show(string $slug)
    {
        $pre_slug='cms-library';
        $pre_slugId=CmsPage::where('slug', $pre_slug)->first();
        if (!$pre_slugId) {
            return response()->json(['success' => 0, 'message' => 'Predefined slug not found.'], 404);
        }
        $library=CmsPage::where('parent_id', $pre_slugId->id)
                        ->where('slug', $slug)
                        ->first();
        if (!$library) {
            return response()->json(['success' => 0, 'message' => 'Library not found.'], 404);
        }
        // dd($library);
        return ['library' => $library,'success' => 1, 'message' => 'Library fetched successfully.'];
        
    }
}
