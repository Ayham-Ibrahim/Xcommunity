<?php

namespace App\Filament\Resources\ArticleGroupResource\Pages;

use App\Filament\Resources\ArticleGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateArticleGroup extends CreateRecord
{
    protected static string $resource = ArticleGroupResource::class;

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }
}
