<?php

namespace App\Filament\Resources\StoreResource\Pages;

use Filament\Actions;
use App\Http\Traits\NotificationTrait;
use App\Filament\Resources\StoreResource;
use Filament\Resources\Pages\CreateRecord;

class CreateStore extends CreateRecord
{
    use NotificationTrait;
    protected static string $resource = StoreResource::class;

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    public function create(bool $another = false): void
    {
        parent::create($another);
        $title = 'New ' . $this->record->type .' Added';
        $body = 'A new ' . $this->record->type .' has been added.';
        $item_id = $this->record->getKey();
        $item_type = 'store';
        $this->sendNotification($title, $body, $item_id, $item_type);
    }
}
