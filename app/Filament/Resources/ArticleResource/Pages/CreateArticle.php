<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use Filament\Actions;
use App\Http\Traits\NotificationTrait;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ArticleResource;

class CreateArticle extends CreateRecord
{
    use NotificationTrait;

    protected static string $resource = ArticleResource::class;

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    public function create(bool $another = false): void
    {
        parent::create($another);

        // If creation is successful, send notification
        $title = 'New Article Added';
        $body = 'A new article has been added.';
        $item_id = $this->record->getKey();
        $item_type = 'article';
        $this->sendNotification($title, $body, $item_id, $item_type);
    }
}
