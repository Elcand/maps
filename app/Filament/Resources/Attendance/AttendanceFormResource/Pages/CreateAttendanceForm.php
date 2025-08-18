<?php

namespace App\Filament\Resources\Attendance\AttendanceFormResource\Pages;

use App\Filament\Resources\Attendance\AttendanceFormResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAttendanceForm extends CreateRecord
{
    protected static string $resource = AttendanceFormResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
