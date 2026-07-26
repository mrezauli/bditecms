<?php

namespace App\Filament\Resources\ExamSessions\Schemas;

use App\Models\ExamSession;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ExamSessionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Session Details')
                    ->schema([
                        TextEntry::make('exam.name'),
                        TextEntry::make('name'),
                        TextEntry::make('exam_date')
                            ->date(),
                        TextEntry::make('registration_starts_at')
                            ->dateTime(),
                        TextEntry::make('registration_ends_at')
                            ->dateTime(),
                        TextEntry::make('result_published_at')
                            ->dateTime()
                            ->placeholder('Not published'),
                        TextEntry::make('status'),
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
                            ->visible(fn (ExamSession $record): bool => $record->trashed()),
                    ]),
            ]);
    }
}
