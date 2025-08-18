<?php

namespace App\Filament\Resources\Attendance\AttendanceFormResource\Pages;

use App\Filament\Resources\Attendance\AttendanceFormResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttendanceForm extends EditRecord
{
    protected static string $resource = AttendanceFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
