<?php

namespace App\Filament\Resources\UniversityCategories\Pages;

use App\Filament\Resources\UniversityCategories\UniversityCategoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUniversityCategory extends ViewRecord
{
    protected static string $resource = UniversityCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
