<?php

namespace App\Filament\Resources\Genders\Schemas;

use App\Models\Gender;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class GenderInfolist
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
                    ->visible(fn (Gender $record): bool => $record->trashed()),
            ]);
    }
}
