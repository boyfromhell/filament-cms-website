<?php

namespace App\CmsPages\Templates\ContentType;

use Filament\Forms;
use SolutionForest\FilamentCms\CmsPages\Contracts\CmsPageTemplate;
use SolutionForest\FilamentCms\CmsPages\Templates\ContentTypeTemplate as BaseTemplate;

class Library extends BaseTemplate implements CmsPageTemplate
{
    public static function schema(): array
    {
        return [
            Forms\Components\Card::make()
                ->schema([
                // Forms\Components\TextInput::make('title')
                //         ->label('Title'),
                // Forms\Components\TextInput::make('content')
                //     ->label(__('filament-cms::filament-cms.fields.cms_page.block-template.content')),
                Forms\Components\Textarea::make('content')
                    ->label('Content')
                    ->rows(3),
                Forms\Components\FileUpload::make('image')
                    ->label('Image')
                    ->image()
                    ->multiple()
                    ->maxFiles(3)
                    ->enableReordering()
                    ->enableDownload()
                    ->enableOpen()
                    ->directory('library'),
                ]),
        ];
    }

    public static function title(): string
    {
        return 'Library';
    }
}
