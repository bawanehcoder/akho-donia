<?php

namespace App\Filament\Resources\ItemOptionResource\Pages;

use App\Filament\Resources\ItemOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItemOptions extends ListRecords
{
    protected static string $resource = ItemOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}