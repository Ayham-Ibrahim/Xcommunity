<?php

namespace App\Filament\Resources\AdvertismaentResource\Pages;

use App\Filament\Resources\AdvertismaentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdvertismaent extends CreateRecord
{
    protected static string $resource = AdvertismaentResource::class;

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }
}
