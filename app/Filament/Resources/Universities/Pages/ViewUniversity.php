<?php

namespace App\Filament\Resources\Universities\Pages;

use App\Filament\Actions\ActivateRecordAction;
use App\Filament\Actions\DeactivateRecordAction;
use App\Filament\Resources\Universities\UniversityResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUniversity extends ViewRecord
{
    protected static string $resource = UniversityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            ActivateRecordAction::make(),
            DeactivateRecordAction::make(),
        ];
    }
}
