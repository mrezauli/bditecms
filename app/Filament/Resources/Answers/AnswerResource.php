<?php

namespace App\Filament\Resources\Answers;

use App\Filament\Resources\Answers\Pages\CreateAnswer;
use App\Filament\Resources\Answers\Pages\EditAnswer;
use App\Filament\Resources\Answers\Pages\ListAnswers;
use App\Filament\Resources\Answers\Pages\ViewAnswer;
use App\Filament\Resources\Answers\Schemas\AnswerForm;
use App\Filament\Resources\Answers\Schemas\AnswerInfolist;
use App\Filament\Resources\Answers\Tables\AnswersTable;
use App\Models\Answer;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class AnswerResource extends Resource
{
    protected static ?string $model = Answer::class;

    protected static string|UnitEnum|null $navigationGroup = 'Q & A';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSpeakerWave;

    protected static ?string $recordTitleAttribute = 'content';

    public static function form(Schema $schema): Schema
    {
        return AnswerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AnswerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AnswersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAnswers::route('/'),
            'create' => CreateAnswer::route('/create'),
            'view' => ViewAnswer::route('/{record}'),
            'edit' => EditAnswer::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
