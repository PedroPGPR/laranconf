<?php

declare(strict_types=1);

namespace App\Filament\Resources\Conferences;

use App\Filament\Resources\Conferences\Pages\CreateConference;
use App\Filament\Resources\Conferences\Pages\EditConference;
use App\Filament\Resources\Conferences\Pages\ListConferences;
use App\Filament\Resources\Conferences\Pages\ViewConference;
use App\Filament\Resources\Conferences\Schemas\ConferenceForm;
use App\Filament\Resources\Conferences\Schemas\ConferenceInfolist;
use App\Filament\Resources\Conferences\Tables\ConferencesTable;
use App\Models\Conference;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Override;

class ConferenceResource extends Resource
{
    protected static ?string $model = Conference::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Conference';

    #[Override]
    public static function form(Schema $schema): Schema
    {
        return ConferenceForm::configure($schema);
    }

    #[Override]
    public static function infolist(Schema $schema): Schema
    {
        return ConferenceInfolist::configure($schema);
    }

    #[Override]
    public static function table(Table $table): Table
    {
        return ConferencesTable::configure($table);
    }

    #[Override]
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    #[Override]
    public static function getPages(): array
    {
        return [
            'index' => ListConferences::route('/'),
            'create' => CreateConference::route('/create'),
            'view' => ViewConference::route('/{record}'),
            'edit' => EditConference::route('/{record}/edit'),
        ];
    }
}
