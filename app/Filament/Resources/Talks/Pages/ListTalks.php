<?php

declare(strict_types=1);

namespace App\Filament\Resources\Talks\Pages;

use App\Filament\Resources\Talks\TalkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Override;

class ListTalks extends ListRecords
{
    protected static string $resource = TalkResource::class;

    #[Override]
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
