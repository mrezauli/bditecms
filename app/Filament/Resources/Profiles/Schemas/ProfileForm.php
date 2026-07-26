<?php

namespace App\Filament\Resources\Profiles\Schemas;

use App\Concerns\ProfileValidationRules;
use App\Models\University;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                DatePicker::make('date_of_birth')
                    ->required()
                    ->beforeOrEqual(ProfileValidationRules::minimumDateOfBirth()),
                Select::make('gender_id')
                    ->relationship('gender', 'name')
                    ->required(),
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
                    ->numeric()
                    ->minValue(1000)
                    ->maxValue(9999),
                Select::make('district_id')
                    ->relationship('district', 'name')
                    ->required(),
                Select::make('university_id')
                    ->relationship('university', 'acronym')
                    ->getOptionLabelFromRecordUsing(fn (University $university) => $university->label)
                    ->required(),
                TextInput::make('occupation')
                    ->required(),
            ]);
    }
}
