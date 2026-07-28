<?php

declare(strict_types=1);

namespace App\Filament\Resources\Venues\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class VenueInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('city'),
                TextEntry::make('country'),
                TextEntry::make('postal_code'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
