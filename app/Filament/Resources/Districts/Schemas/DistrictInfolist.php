<?php

namespace App\Filament\Resources\Districts\Schemas;

use App\Models\District;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DistrictInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('name_bn')
                    ->label('Name (Bengali)'),
                TextEntry::make('division.name')
                    ->label('Division'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (District $record): bool => $record->trashed()),
            ]);
    }
}
