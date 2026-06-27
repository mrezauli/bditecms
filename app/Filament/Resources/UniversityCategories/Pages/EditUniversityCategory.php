<?php

namespace App\Filament\Resources\UniversityCategories\Pages;

use App\Filament\Resources\UniversityCategories\UniversityCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditUniversityCategory extends EditRecord
{
    protected static string $resource = UniversityCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
