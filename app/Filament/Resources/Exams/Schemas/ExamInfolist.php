<?php

namespace App\Filament\Resources\Exams\Schemas;

use App\Models\Exam;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ExamInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Info')
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('acronym'),
                        TextEntry::make('level'),
                        TextEntry::make('details')
                            ->columnSpanFull()
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
                            ->visible(fn(Exam $record): bool => $record->trashed()),

                    ]),
            ]);
    }
}
