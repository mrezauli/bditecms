<?php

namespace App\Filament\Resources\HalfPassers\Schemas;

use App\Models\HalfPasser;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HalfPasserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Info')
                    ->schema([
                        TextEntry::make('examinee_no'),
                        TextEntry::make('name'),
                        TextEntry::make('type.name')
                            ->label('Type'),
                        TextEntry::make('intake.name')
                            ->label('Intake'),
                    ]),

                Section::make('Timestamps')
                    ->schema([
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('deleted_at')
                            ->dateTime()
                            ->visible(fn (HalfPasser $record): bool => $record->trashed()),
                    ]),
            ]);
    }
}
