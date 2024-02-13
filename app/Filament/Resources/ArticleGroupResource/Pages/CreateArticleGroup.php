<?php

namespace App\Filament\Resources\ArticleGroupResource\Pages;

use Filament\Actions;
use App\Http\Traits\NotificationTrait;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ArticleGroupResource;

class CreateArticleGroup extends CreateRecord
{
    // use NotificationTrait;
    protected static string $resource = ArticleGroupResource::class;

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    // public function create(bool $another = false): void
    // {
    //     parent::create($another);
    //     $title = 'New ArticleGroup Added';
    //     $body = 'A new ArticleGroup has been added.';
    //     $item_id = $this->record->getKey();
    //     $item_type = 'articleGroup';
    //     $this->sendNotification($title, $body, $item_id, $item_type);
    // }
}
