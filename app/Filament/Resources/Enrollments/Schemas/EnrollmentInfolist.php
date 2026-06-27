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
                TextEntry::make('exam_id')
                    ->numeric(),
                TextEntry::make('type_id')
                    ->numeric(),
                TextEntry::make('site_id')
                    ->numeric(),
                TextEntry::make('first_answer_id')
                    ->numeric(),
                TextEntry::make('second_answer_id')
                    ->numeric(),
                TextEntry::make('third_answer_id')
                    ->numeric(),
                TextEntry::make('fourth_answer_id')
                    ->numeric(),
                TextEntry::make('fifth_answer_id')
                    ->numeric(),
                TextEntry::make('sixth_answer_id')
                    ->numeric(),
                TextEntry::make('seventh_answer_id')
                    ->numeric(),
                TextEntry::make('eighth_answer_id')
                    ->numeric(),
                TextEntry::make('ninth_answer_id')
                    ->numeric(),
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
