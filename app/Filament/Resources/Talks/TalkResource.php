<?php

declare(strict_types=1);

namespace App\Filament\Resources\Talks;

use App\Filament\Resources\Talks\Pages\CreateTalk;
use App\Filament\Resources\Talks\Pages\EditTalk;
use App\Filament\Resources\Talks\Pages\ListTalks;
use App\Filament\Resources\Talks\Pages\ViewTalk;
use App\Filament\Resources\Talks\Schemas\TalkForm;
use App\Filament\Resources\Talks\Schemas\TalkInfolist;
use App\Filament\Resources\Talks\Tables\TalksTable;
use App\Models\Talk;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Override;

class TalkResource extends Resource
{
    protected static ?string $model = Talk::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Talks';

    #[Override]
    public static function form(Schema $schema): Schema
    {
        return TalkForm::configure($schema);
    }

    #[Override]
    public static function infolist(Schema $schema): Schema
    {
        return TalkInfolist::configure($schema);
    }

    #[Override]
    public static function table(Table $table): Table
    {
        return TalksTable::configure($table);
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
            'index' => ListTalks::route('/'),
            'create' => CreateTalk::route('/create'),
            'view' => ViewTalk::route('/{record}'),
            'edit' => EditTalk::route('/{record}/edit'),
        ];
    }
}
