<?php

namespace App\Filament\Resources\Attendance\AttendanceFormResource\Pages;

use App\Filament\Resources\Attendance\AttendanceFormResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttendanceForms extends ListRecords
{
    protected static string $resource = AttendanceFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
