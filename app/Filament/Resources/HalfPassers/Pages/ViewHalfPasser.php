<?php

namespace App\Filament\Resources\HalfPassers\Pages;

use App\Filament\Actions\ActivateRecordAction;
use App\Filament\Actions\DeactivateRecordAction;
use App\Filament\Resources\HalfPassers\HalfPasserResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewHalfPasser extends ViewRecord
{
    protected static string $resource = HalfPasserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            ActivateRecordAction::make(),
            DeactivateRecordAction::make(),
        ];
    }
}
