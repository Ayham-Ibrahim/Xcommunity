<?php

namespace App\Filament\Resources\AdvertismaentResource\Pages;

use App\Filament\Resources\AdvertismaentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdvertismaent extends EditRecord
{
    protected static string $resource = AdvertismaentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }


    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }
}
