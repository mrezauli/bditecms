<?php

namespace App\Filament\Resources\HalfPassers\Pages;

use App\Filament\Resources\HalfPassers\HalfPasserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHalfPassers extends ListRecords
{
    protected static string $resource = HalfPasserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
