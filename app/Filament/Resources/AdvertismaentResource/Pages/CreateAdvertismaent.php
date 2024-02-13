<?php

namespace App\Filament\Resources\AdvertismaentResource\Pages;

use Filament\Actions;
use App\Http\Traits\NotificationTrait;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\AdvertismaentResource;

class CreateAdvertismaent extends CreateRecord
{
    use NotificationTrait;
    protected static string $resource = AdvertismaentResource::class;

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    public function create(bool $another = false): void
    {
        parent::create($another);
        $title = 'New Advertisment Added';
        $body = 'A new Advertisment has been added.';
        $item_id = $this->record->getKey();
        $item_type = 'advertismaent';
        $this->sendNotification($title, $body, $item_id, $item_type);
    }
}
