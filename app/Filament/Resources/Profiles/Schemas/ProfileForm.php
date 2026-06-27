<?php

namespace App\Filament\Resources\Profiles\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                DatePicker::make('date_of_birth')
                    ->required(),
                TextInput::make('gender_id')
                    ->required()
                    ->numeric(),
                TextInput::make('mobile_number')
                    ->required()
                    ->numeric(),
                Textarea::make('present_address')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('work_address')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('post_code')
                    ->required()
                    ->numeric(),
                TextInput::make('district_id')
                    ->required()
                    ->numeric(),
                TextInput::make('university_id')
                    ->required()
                    ->numeric(),
                TextInput::make('occupation')
                    ->required(),
            ]);
    }
}
