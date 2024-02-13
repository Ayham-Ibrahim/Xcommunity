<?php

namespace App\Filament\Resources\UserInfoResource\Pages;

use App\Filament\Resources\UserInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserInfo extends EditRecord
{
    protected static string $resource = UserInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
