<?php

namespace App\Filament\Resources\AdvertismaentResource\Pages;

use App\Filament\Resources\AdvertismaentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdvertismaents extends ListRecords
{
    protected static string $resource = AdvertismaentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
