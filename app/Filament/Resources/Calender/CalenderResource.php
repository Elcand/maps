<?php

namespace App\Filament\Resources\Calender;

use App\Filament\Resources\Calender\CalenderResource\Pages;
use App\Filament\Resources\Calender\CalenderResource\RelationManagers;
use App\Models\Calender;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CalenderResource extends Resource
{
    protected static ?string $model = Calender::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                Grid::make()
                    ->schema([
                        DateTimePicker::make('start_date'),
                        DateTimePicker::make('end_date'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('start_date'),
                TextColumn::make('end_date'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCalenders::route('/'),
            'create' => Pages\CreateCalender::route('/create'),
            'edit' => Pages\EditCalender::route('/{record}/edit'),
        ];
    }
}
