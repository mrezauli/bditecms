<?php

namespace App\Filament\Resources\Intakes\Pages;

use App\Filament\Actions\ActivateRecordAction;
use App\Filament\Actions\DeactivateRecordAction;
use App\Filament\Resources\Intakes\IntakeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewIntake extends ViewRecord
{
    protected static string $resource = IntakeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            ActivateRecordAction::make(),
            DeactivateRecordAction::make(),
        ];
    }
}
