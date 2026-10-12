<?php

namespace App\Filament\Resources\Profiles\Schemas;

use App\Concerns\ProfileValidationRules;
use App\Models\University;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class ProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name', fn (Builder $query) => $query->orderBy('name'))
                    ->required(),
                DatePicker::make('date_of_birth')
                    ->required()
                    ->beforeOrEqual(ProfileValidationRules::minimumDateOfBirth()),
                Select::make('gender_id')
                    ->relationship('gender', 'name', fn (Builder $query) => $query->orderBy('name'))
                    ->required(),
                TextInput::make('mobile_number')
                    ->required()
                    ->numeric()
                    ->unique(),
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
                    ->relationship('district', 'name', fn (Builder $query) => $query->orderBy('name'))
                    ->required(),
                Select::make('university_id')
                    ->label('University')
                    ->options(fn (): array => ['other' => __('Not Listed')] + University::orderBy('name')->get()->mapWithKeys(fn (University $university) => [$university->id => $university->label])->all())
                    ->afterStateHydrated(function ($state, $set, $record): void {
                        if ($record && blank($record->university_id) && filled($record->other_university_name)) {
                            $set('university_id', 'other');
                        }
                    })
                    ->afterStateUpdated(function ($state, $set): void {
                        if ($state !== 'other') {
                            $set('other_university_name', null);
                        }
                    })
                    ->dehydrateStateUsing(fn ($state) => $state === 'other' ? null : $state)
                    ->live()
                    ->required(),
                TextInput::make('other_university_name')
                    ->label('Other University Name')
                    ->visible(fn (Get $get): bool => $get('university_id') === 'other')
                    ->required(fn (Get $get): bool => $get('university_id') === 'other')
                    ->maxLength(255),
                TextInput::make('occupation')
                    ->required(),
            ]);
    }
}
