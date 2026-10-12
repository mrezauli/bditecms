<?php

namespace App\Filament\Resources\Enrollments\Tables;

use App\Filament\Actions\ActivateRecordAction;
use App\Filament\Actions\DeactivateRecordAction;
use App\Filament\Resources\Enrollments\EnrollmentResource;
use App\Models\Enrollment;
use App\Models\Question;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use OccTherapist\AdvancedTableExportForFilament\Actions\TableExportHeaderAction;

class EnrollmentsTable
{
    /**
     * Truncate a text column to 3 words with a "More" link to the view record.
     */
    protected static function previewColumn(TextColumn $column): TextColumn
    {
        return $column
            ->words(3)
            ->description(fn ($state): ?string => str_word_count((string) $state) > 3 ? 'More' : null)
            ->url(fn (Enrollment $record): string => EnrollmentResource::getUrl('view', ['record' => $record]));
    }

    /**
     * Current question label for the given answer position (0 = 1st answer).
     * Falls back to the ordinal label when no active question exists.
     */
    protected static function questionLabel(int $index, string $fallback): string
    {
        $label = Question::currentStatus('active')->orderBy('label')->skip($index)->value('label');

        return $label ?? $fallback;
    }

    /**
     * Answer column showing the answer label under the question label header.
     */
    protected static function answerColumn(string $relation, string $fallbackLabel, int $index): TextColumn
    {
        return self::previewColumn(
            TextColumn::make("{$relation}.label")
                ->label(fn (): string => self::questionLabel($index, $fallbackLabel))
                ->sortable()
        );
    }

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                self::previewColumn(TextColumn::make('exam.acronym')
                    ->label('Exam')
                    ->sortable()),
                self::previewColumn(TextColumn::make('user.name')
                    ->label('Name')
                    ->sortable()),
                TextColumn::make('user.profile.date_of_birth')
                    ->label('DOB')
                    ->date(),
                self::previewColumn(TextColumn::make('user.profile.gender.name')
                    ->label('Gender')),
                self::previewColumn(TextColumn::make('site.name')
                    ->label('Site')
                    ->sortable()),
                TextColumn::make('user.profile.mobile_number')
                    ->label('Mobile Number')
                    ->prefix('01'),
                TextColumn::make('user.email')
                    ->label('Email'),
                self::previewColumn(TextColumn::make('user.profile.present_address')
                    ->label('Present Address')),
                TextColumn::make('user.profile.post_code')
                    ->label('Post Code'),
                self::answerColumn('firstAnswer', '1st Answer', 0),
                self::answerColumn('secondAnswer', '2nd Answer', 1),
                self::answerColumn('thirdAnswer', '3rd Answer', 2),
                self::answerColumn('fourthAnswer', '4th Answer', 3),
                self::answerColumn('fifthAnswer', '5th Answer', 4),
                self::answerColumn('sixthAnswer', '6th Answer', 5),
                self::answerColumn('seventhAnswer', '7th Answer', 6),
                self::answerColumn('eighthAnswer', '8th Answer', 7),
                self::answerColumn('ninthAnswer', '9th Answer', 8),
                self::previewColumn(TextColumn::make('user.profile.district.name')
                    ->label('District')),
                self::previewColumn(TextColumn::make('user.profile.university.acronym')
                    ->label('University')),
                self::previewColumn(TextColumn::make('type.name')
                    ->label('Type')
                    ->sortable()),
                TextColumn::make('payment.status')
                    ->label('Payment Status')
                    ->badge(),
                TextColumn::make('payment.transaction_id')
                    ->label('Transaction ID'),
                TextColumn::make('payment.amount')
                    ->label('Amount'),
                self::previewColumn(TextColumn::make('user.profile.occupation')
                    ->label('Occupation')),
                TextColumn::make('payment.created_at')
                    ->label('Payment Time')
                    ->dateTime()
                    ->placeholder('-'),
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
            ->defaultSort('created_at', 'desc')
            ->filters([
                TrashedFilter::make(),
            ])
            ->headerActions([
                TableExportHeaderAction::make(),
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
