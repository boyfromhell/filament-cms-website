<?php

namespace App\Filament\Resources\ContentType;

use App\Filament\Resources\ContentType\ArticleResource\Pages;
use App\CmsPages\Templates\ContentType\Article as Template;
use Filament\Forms;
use Illuminate\Database\Eloquent\Builder;
use SolutionForest\FilamentCms\Enums\PageType;
use SolutionForest\FilamentCms\Filament\Resources\ContentTypePageBaseResource as BaseResource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

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

    // public static function table(Table $table): Table
    // {
    //     return $table
    //         ->columns([
    //             TextColumn::make('id'),
    //             TextColumn::make('slug'),
    //             TextColumn::make('url'),

    //             TextColumn::make('status'),
    //             TextColumn::make('live'),
    //             TextColumn::make('created_at')->dateTime(),
    //             TextColumn::make('updated_at')->dateTime(),
    //         ])
    //         ->filters([
    //             //
    //         ])
    //         ->actions([
    //             Tables\Actions\EditAction::make(),
    //         ])
    //         ->bulkActions([
    //             Tables\Actions\DeleteBulkAction::make(),
    //         ]);
    // }

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
