<?php

namespace App\Filament\Resources\ContentType;

use App\Filament\Resources\ContentType\ArticleResource\Pages;
use App\CmsPages\Templates\ContentType\Article as Template;
use Filament\Forms;
use App\Models\CmsPage;
use Illuminate\Database\Eloquent\Builder;
use SolutionForest\FilamentCms\Enums\PageType;
use SolutionForest\FilamentCms\Filament\Resources\ContentTypePageBaseResource as BaseResource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ArticleResource extends BaseResource
{
    use \Filament\Resources\Concerns\Translatable;

    protected static ?int $navigationSort = null;

    protected static $parentPageKey = '2';

    protected static string $subSlug = 'cms-article';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return 'Article';
    }

    public static function table(Table $table): Table
    {
        return parent::table($table)
            // avoid edit docs
            ->checkIfRecordIsSelectableUsing(fn (CmsPage $record) => ! $record->isDocumentPage())
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'reviewing' => 'warning',
                        'published' => 'success',
                        'rejected' => 'danger',
                    })
                    ->formatStateUsing([
                        'draft' => 'Draft',
                        'reviewing' => 'Reviewing',
                        'published' => 'Published',
                    ]),
                // TextColumn::make('live?'),
                TextColumn::make('created_at')->dateTime()
                     ->sortable(),
                TextColumn::make('updated_at')->dateTime()
                     ->sortable(),
                ]);
            // ->filters([
            //                 //
            // ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'edit' => Pages\EditArticle::route('/{record:id}/edit'),
            'create' => Pages\CreateArticle::route('/create'),
        ];
    }

    public static function getTemplate(): string
    {
        return Template::class;
    }
}
