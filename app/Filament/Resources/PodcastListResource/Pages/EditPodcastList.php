<?php

namespace App\Filament\Resources\PodcastListResource\Pages;

use App\Filament\Resources\PodcastListResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPodcastList extends EditRecord
{
    protected static string $resource = PodcastListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
