<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Seo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use SolutionForest\FilamentCms\Models\CmsPage as BaseModel;
use Spatie\Translatable\HasTranslations;

class CmsPage extends BaseModel
{
    use HasTranslations;
    protected $translatable = [
        'title',
        'data',
    ];

    public function isDocumentPage(): bool
    {
        if (is_null($this->parent_id)) {
            return $this->slug == 'docs';
        }
        return $this->parentPage?->isDocumentPage() ?? false;
    }
    // public function seo(): HasOne
    // {
    //     return $this->hasOne(Seo::class,'foreign_key', 'local_key');
    // }
}
