<?php

namespace App\Filament\Resources\ChildCategoryResource\Pages;

use App\Filament\Resources\ChildCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChildCategories extends ListRecords
{
    protected static string $resource = ChildCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
