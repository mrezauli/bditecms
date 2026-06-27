<?php

namespace App\Filament\Resources\Enrollments\Schemas;

use App\Models\Enrollment;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EnrollmentInfolist
{
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
                TextEntry::make('firstAnswer.label')
                    ->label('1st Answer'),
                TextEntry::make('secondAnswer.label')
                    ->label('2nd Answer'),
                TextEntry::make('thirdAnswer.label')
                    ->label('3rd Answer'),
                TextEntry::make('fourthAnswer.label')
                    ->label('4th Answer'),
                TextEntry::make('fifthAnswer.label')
                    ->label('5th Answer'),
                TextEntry::make('sixthAnswer.label')
                    ->label('6th Answer'),
                TextEntry::make('seventhAnswer.label')
                    ->label('7th Answer'),
                TextEntry::make('eighthAnswer.label')
                    ->label('8th Answer'),
                TextEntry::make('ninthAnswer.label')
                    ->label('9th Answer'),
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
