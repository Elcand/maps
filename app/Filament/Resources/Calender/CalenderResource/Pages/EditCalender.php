<?php

namespace App\Filament\Resources\Calender\CalenderResource\Pages;

use App\Filament\Resources\Calender\CalenderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCalender extends EditRecord
{
    protected static string $resource = CalenderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
