<?php

namespace App\Filament\Resources\PodcastListResource\Pages;

use App\Filament\Resources\PodcastListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPodcastLists extends ListRecords
{
    protected static string $resource = PodcastListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
