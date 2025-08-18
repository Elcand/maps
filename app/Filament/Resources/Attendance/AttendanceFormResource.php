<?php

namespace App\Filament\Resources\Attendance;

use App\Filament\Resources\Attendance\AttendanceFormResource\Pages;
use App\Filament\Resources\Attendance\AttendanceFormResource\RelationManagers;
use App\Models\Location;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class AttendanceFormResource extends Resource
{
    protected static ?string $model = Location::class;
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationGroup = 'Attendance';
    protected static ?string $navigationLabel = 'Form';
    protected static ?int $navigationSort = 1;

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Map::make('location')
                            ->label('Lokasi Absen')
                            ->geolocate()
                            ->geolocateLabel('Dapatkan Lokasi')
                            ->geolocateOnLoad(true, true)
                            ->defaultZoom(17)
                            ->height('400px')
                            ->afterStateUpdated(function ($state, callable $set) {
                                if (isset($state['lat']) && isset($state['lng'])) {
                                    $set('latitude', $state['lat']);
                                    $set('longitude', $state['lng']);
                                    $set('check_in_time', now());
                                }
                            }),

                        Hidden::make('latitude'),
                        Hidden::make('longitude'),
                        Hidden::make('user_id')
                            ->label('User')
                            ->default(fn() => auth()->id())
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->sortable()->searchable(),
                TextColumn::make('check_in_time')->date('H:i'),
                TextColumn::make('latitude')->sortable()->searchable(),
                TextColumn::make('longitude')->sortable()->searchable(),
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
            'index' => Pages\ListAttendanceForms::route('/'),
            'create' => Pages\CreateAttendanceForm::route('/create'),
            'edit' => Pages\EditAttendanceForm::route('/{record}/edit'),
        ];
    }
}
