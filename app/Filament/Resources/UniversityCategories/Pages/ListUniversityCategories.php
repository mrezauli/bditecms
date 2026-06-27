<?php

namespace App\Filament\Resources\UniversityCategories\Pages;

use App\Filament\Resources\UniversityCategories\UniversityCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUniversityCategories extends ListRecords
{
    protected static string $resource = UniversityCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
