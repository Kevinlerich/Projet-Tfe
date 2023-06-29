<?php

namespace App\Filament\Resources\PhotographeProvinceResource\Pages;

use App\Filament\Resources\PhotographeProvinceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPhotographeProvince extends EditRecord
{
    protected static string $resource = PhotographeProvinceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
