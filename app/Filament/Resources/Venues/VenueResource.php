<?php

declare(strict_types=1);

namespace App\Filament\Resources\Venues;

use App\Filament\Resources\Venues\Pages\CreateVenue;
use App\Filament\Resources\Venues\Pages\EditVenue;
use App\Filament\Resources\Venues\Pages\ListVenues;
use App\Filament\Resources\Venues\Pages\ViewVenue;
use App\Filament\Resources\Venues\Schemas\VenueForm;
use App\Filament\Resources\Venues\Schemas\VenueInfolist;
use App\Filament\Resources\Venues\Tables\VenuesTable;
use App\Models\Venue;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Override;

class VenueResource extends Resource
{
    protected static ?string $model = Venue::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Venues';

    #[Override]
    public static function form(Schema $schema): Schema
    {
        return VenueForm::configure($schema);
    }

    #[Override]
    public static function infolist(Schema $schema): Schema
    {
        return VenueInfolist::configure($schema);
    }

    #[Override]
    public static function table(Table $table): Table
    {
        return VenuesTable::configure($table);
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
            'index' => ListVenues::route('/'),
            'create' => CreateVenue::route('/create'),
            'view' => ViewVenue::route('/{record}'),
            'edit' => EditVenue::route('/{record}/edit'),
        ];
    }
}
