<?php

namespace App\CmsPages\Templates\ContentType;

use Filament\Forms;
use SolutionForest\FilamentCms\CmsPages\Contracts\CmsPageTemplate;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\RichEditor;
use SolutionForest\FilamentCms\CmsPages\Templates\ContentTypeTemplate as BaseTemplate;

class Library extends BaseTemplate implements CmsPageTemplate
{
    public static function schema(): array
    {
        return [
            RichEditor::make('content')->label("Content")
        ];
    }

    public static function title(): string
    {
        return 'Library';
    }
}
