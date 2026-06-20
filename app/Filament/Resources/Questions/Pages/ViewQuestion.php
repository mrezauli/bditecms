<?php

namespace App\Filament\Resources\Questions\Pages;

use App\Filament\Actions\ActivateRecordAction;
use App\Filament\Actions\DeactivateRecordAction;
use App\Filament\Resources\Questions\QuestionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewQuestion extends ViewRecord
{
    protected static string $resource = QuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            ActivateRecordAction::make(),
            DeactivateRecordAction::make(),
        ];
    }
}
