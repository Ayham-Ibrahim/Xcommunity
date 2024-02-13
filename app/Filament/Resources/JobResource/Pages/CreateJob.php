<?php

namespace App\Filament\Resources\JobResource\Pages;

use Filament\Actions;
use App\Http\Traits\NotificationTrait;
use App\Filament\Resources\JobResource;
use Filament\Resources\Pages\CreateRecord;

class CreateJob extends CreateRecord
{
    use NotificationTrait;
    protected static string $resource = JobResource::class;

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    public function create(bool $another = false): void
    {
        parent::create($another);
        $title = 'New Job Added';
        $body = 'A new Job has been added.';
        $item_id = $this->record->getKey();
        $item_type = 'job';
        $this->sendNotification($title, $body, $item_id, $item_type);
    }
}
