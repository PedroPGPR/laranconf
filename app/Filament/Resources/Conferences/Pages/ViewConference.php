<?php

declare(strict_types=1);

namespace App\Filament\Resources\Conferences\Pages;

use App\Filament\Resources\Conferences\ConferenceResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Override;

class ViewConference extends ViewRecord
{
    protected static string $resource = ConferenceResource::class;

    #[Override]
    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
