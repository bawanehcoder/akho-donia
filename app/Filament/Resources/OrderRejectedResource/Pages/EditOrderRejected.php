<?php

namespace App\Filament\Resources\OrderRejectedResource\Pages;

use App\Filament\Resources\OrderRejectedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrderRejected extends EditRecord
{
    protected static string $resource = OrderRejectedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
