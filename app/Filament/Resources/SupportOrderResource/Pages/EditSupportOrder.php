<?php

namespace App\Filament\Resources\SupportOrderResource\Pages;

use App\Filament\Resources\SupportOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSupportOrder extends EditRecord
{
    protected static string $resource = SupportOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
