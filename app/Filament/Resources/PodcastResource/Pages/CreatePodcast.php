<?php

namespace App\Filament\Resources\PodcastResource\Pages;

use Filament\Actions;
use App\Http\Traits\NotificationTrait;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PodcastResource;

class CreatePodcast extends CreateRecord
{
    use NotificationTrait;
    protected static string $resource = PodcastResource::class;

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    public function create(bool $another = false): void
    {
        parent::create($another);
        $title = 'New Podcast Added';
        $body = 'A new Podcast has been added.';
        $item_id = $this->record->getKey();
        $item_type = 'podcast';
        $this->sendNotification($title, $body, $item_id, $item_type);
    }
}
