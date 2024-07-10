<?php

namespace App\CmsPages\Templates;

use Filament\Forms;
use SolutionForest\FilamentCms\CmsPages\Contracts\CmsPageTemplate;
use SolutionForest\FilamentCms\CmsPages\Renderer\AtomicDesignPageRenderer;

final class LibraryTemplate implements CmsPageTemplate
{
    protected static ?string $view = null;

    public static function title(): string
    {
        return 'LibraryTemplate';
    }

    public static function schema(): array
    {
        return [
            Forms\Components\Card::make()
                ->schema([
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

    public static function getRenderer(): ?string
    {
        return static::$view ?? AtomicDesignPageRenderer::class;
    }

    public static function hiddenOnTemplateOptions(): bool
    {
        return false;
    }
}
