<?php

namespace App\Filament\Resources\Genders\Pages;

use App\Filament\Resources\Genders\GenderResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewGender extends ViewRecord
{
    protected static string $resource = GenderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
