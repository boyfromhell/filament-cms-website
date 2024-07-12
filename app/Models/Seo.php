<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SolutionForest\FilamentTree\Concern\ModelTree;

class Seo extends Model
{
    // use ModelTree;

    protected $fillable = ["description", "keywords", "title","image","author"];

    protected $table = 'seo';

}
