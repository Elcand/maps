<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Calender\CalenderResource;
use App\Models\Calender;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{
    public Model | string | null $model = Calender::class;

    public function fetchEvents(array $fetchInfo): array
    {
        return Calender::query()
            ->where('start_date', '>=', $fetchInfo['start'])
            ->where('end_date', '<=', $fetchInfo['end'])
            ->get()
            ->map(function (Calender $event) {
                return [
                    'id' => $event->id,
                    'title' => $event->name,
                    'start' => $event->start_date,
                    'end' => $event->end_date,
                ];
            })
            ->toArray();
    }


    public function getFormSchema(): array
    {
        return [
            TextInput::make('name'),
            Grid::make()
                ->schema([
                    DateTimePicker::make('start_date'),
                    DateTimePicker::make('end_date'),
                ]),
        ];
    }
}
