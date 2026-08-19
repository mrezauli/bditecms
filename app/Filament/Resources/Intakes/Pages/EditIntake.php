<?php

namespace App\Filament\Resources\Intakes\Pages;

use App\Filament\Actions\ActivateRecordAction;
use App\Filament\Actions\DeactivateRecordAction;
use App\Filament\Resources\Intakes\IntakeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditIntake extends EditRecord
{
    protected static string $resource = IntakeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            ActivateRecordAction::make(),
            DeactivateRecordAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
