<?php

namespace App\Filament\Resources\UniversityCategories\Schemas;

use App\Models\UniversityCategory;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UniversityCategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (UniversityCategory $record): bool => $record->trashed()),
            ]);
    }
}
