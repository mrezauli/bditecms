<?php

namespace App\Filament\Resources\Enrollments\Tables;

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
                TextColumn::make('exam_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('type_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('site_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('first_answer_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('second_answer_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('third_answer_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('fourth_answer_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('fifth_answer_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sixth_answer_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('seventh_answer_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('eighth_answer_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('ninth_answer_id')
                    ->numeric()
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
