<?php

declare(strict_types=1);

namespace App\Filament\Resources\Talks\Pages;

use App\Filament\Resources\Talks\TalkResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Override;

class EditTalk extends EditRecord
{
    protected static string $resource = TalkResource::class;

    #[Override]
    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
