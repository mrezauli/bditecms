<?php

namespace App\Filament\Resources\Enrollments\Tables;

use App\Filament\Actions\ActivateRecordAction;
use App\Filament\Actions\DeactivateRecordAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class EnrollmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('exam.acronym')
                    ->label('Exam')
                    ->sortable(),
                TextColumn::make('type.name')
                    ->label('Type')
                    ->sortable(),
                TextColumn::make('site.name')
                    ->label('Site')
                    ->sortable(),
                TextColumn::make('firstAnswer.label')
                    ->label('1st Answer')
                    ->sortable(),
                TextColumn::make('secondAnswer.label')
                    ->label('2nd Answer')
                    ->sortable(),
                TextColumn::make('thirdAnswer.label')
                    ->label('3rd Answer')
                    ->sortable(),
                TextColumn::make('fourthAnswer.label')
                    ->label('4th Answer')
                    ->sortable(),
                TextColumn::make('fifthAnswer.label')
                    ->label('5th Answer')
                    ->sortable(),
                TextColumn::make('sixthAnswer.label')
                    ->label('6th Answer')
                    ->sortable(),
                TextColumn::make('seventhAnswer.label')
                    ->label('7th Answer')
                    ->sortable(),
                TextColumn::make('eighthAnswer.label')
                    ->label('8th Answer')
                    ->sortable(),
                TextColumn::make('ninthAnswer.label')
                    ->label('9th Answer')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                ActivateRecordAction::make(),
                DeactivateRecordAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
