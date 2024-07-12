<?php

namespace App\CmsPages\Templates\ContentType;

use Filament\Forms;
use SolutionForest\FilamentCms\CmsPages\Contracts\CmsPageTemplate;
use SolutionForest\FilamentCms\CmsPages\Templates\IndexContentTypeTemplate as BaseTemplate;

class ArticleIndex extends BaseTemplate implements CmsPageTemplate
{
    public static function schema(): array
    {
        return [];
    }

    public static function title(): string
    {
        return 'ArticleIndex';
    }

    public static function getIndexPageKey()
    {
        return '2';
    }
}
