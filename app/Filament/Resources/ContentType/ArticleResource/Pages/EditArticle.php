<?php

namespace App\Filament\Resources\ContentType\ArticleResource\Pages;

use Filament\Resources\Pages\EditRecord;
use SolutionForest\FilamentCms\Concern;
use App\Filament\Resources\ContentType\ArticleResource;
use Filament\Actions\LocaleSwitcher;

class EditArticle extends EditRecord
{
    // use EditRecord\Concerns\Translatable {
    //     EditRecord\Concerns\Translatable::getActions as protected translatableActions;
    // }
    use EditRecord\Concerns\Translatable;
    use Concern\CanPublishPage;
    use Concern\CanPreviewPage {
        Concern\CanPreviewPage::getActions as protected previewPageActions;
    }

    protected static string $resource = ArticleResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        return static::getResource()::mutateFormDataBeforeFill($data);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return static::getResource()::mutateFormDataBeforeSave($data);
    }

    protected function afterCreate()
    {
        $this->dispatch('updateAudits');
    }

    protected function afterSave()
    {
        $this->dispatch('updateAudits');
    }

    public function getActions(): array
    {
        return array_merge(
            [LocaleSwitcher::make()],
            $this->previewPageActions(),
        );
    }
}
