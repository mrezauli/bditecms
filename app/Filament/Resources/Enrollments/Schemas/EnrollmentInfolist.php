<?php

namespace App\Filament\Resources\Enrollments\Schemas;

use App\Models\Enrollment;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EnrollmentInfolist
{
    protected static function answerEntry(string $relation, string $label): TextEntry
    {
        return TextEntry::make("{$relation}.content")
            ->label($label)
            ->helperText(fn (Enrollment $record): ?string => $record->{$relation}?->question?->content);
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('exam.acronym')
                    ->label('Exam'),
                TextEntry::make('type.name')
                    ->label('Type'),
                TextEntry::make('site.name')
                    ->label('Site'),
                self::answerEntry('firstAnswer', '1st Answer'),
                self::answerEntry('secondAnswer', '2nd Answer'),
                self::answerEntry('thirdAnswer', '3rd Answer'),
                self::answerEntry('fourthAnswer', '4th Answer'),
                self::answerEntry('fifthAnswer', '5th Answer'),
                self::answerEntry('sixthAnswer', '6th Answer'),
                self::answerEntry('seventhAnswer', '7th Answer'),
                self::answerEntry('eighthAnswer', '8th Answer'),
                self::answerEntry('ninthAnswer', '9th Answer'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Enrollment $record): bool => $record->trashed()),
            ]);
    }
}
