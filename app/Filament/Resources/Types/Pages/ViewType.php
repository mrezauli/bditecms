<?php

namespace App\Filament\Resources\Types\Pages;

use App\Filament\Actions\ActivateRecordAction;
use App\Filament\Actions\DeactivateRecordAction;
use App\Filament\Resources\Types\TypeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewType extends ViewRecord
{
    protected static string $resource = TypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            ActivateRecordAction::make(),
            DeactivateRecordAction::make(),
        ];
    }
}
