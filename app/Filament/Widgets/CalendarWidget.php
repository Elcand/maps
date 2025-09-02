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
