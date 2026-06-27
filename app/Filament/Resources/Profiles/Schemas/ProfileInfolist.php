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
                TextEntry::make('user_id')
                    ->numeric(),
                TextEntry::make('date_of_birth')
                    ->date(),
                TextEntry::make('gender_id')
                    ->numeric(),
                TextEntry::make('mobile_number')
                    ->numeric(),
                TextEntry::make('present_address')
                    ->columnSpanFull(),
                TextEntry::make('work_address')
                    ->columnSpanFull(),
                TextEntry::make('post_code')
                    ->numeric(),
                TextEntry::make('district_id')
                    ->numeric(),
                TextEntry::make('university_id')
                    ->numeric(),
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
