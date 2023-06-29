<?php

namespace App\Filament\Resources\PhotographeProvinceResource\Pages;

use App\Filament\Resources\PhotographeProvinceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPhotographeProvinces extends ListRecords
{
    protected static string $resource = PhotographeProvinceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
