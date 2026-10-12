<?php

namespace App\Filament\Resources\Profiles\Schemas;

use App\Models\Profile;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProfileInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('date_of_birth')
                    ->date(),
                TextEntry::make('gender.name')
                    ->label('Gender'),
                TextEntry::make('mobile_number')
                    ->numeric(),
                TextEntry::make('present_address')
                    ->columnSpanFull(),
                TextEntry::make('work_address')
                    ->columnSpanFull(),
                TextEntry::make('post_code')
                    ->numeric(),
                TextEntry::make('district.name')
                    ->label('District'),
                TextEntry::make('university.acronym')
                    ->label('University'),
                TextEntry::make('other_university_name')
                    ->label('Other University Name')
                    ->placeholder('-'),
                TextEntry::make('occupation'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Profile $record): bool => $record->trashed()),
            ]);
    }
}
