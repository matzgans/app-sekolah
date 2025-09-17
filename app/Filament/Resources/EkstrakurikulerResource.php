<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EkstrakurikulerResource\Pages;
use App\Filament\Resources\EkstrakurikulerResource\RelationManagers;
use App\Models\Ekstrakurikuler;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EkstrakurikulerResource extends Resource
{
    protected static ?string $model = Ekstrakurikuler::class;

    protected static ?string $navigationLabel = 'Ekstrakurikuler';

    protected static ?string $navigationIcon = 'heroicon-o-lifebuoy';

    protected static ?string $navigationGroup = 'Menejemen Akademik';

    protected static ?int $navigationSort = 5;

    public static function getPluralLabel(): string
    {
        return 'Ekstrakurikuler';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_ekskul')
                    ->required(),

                Forms\Components\TextInput::make('nama_pembina'),

                Forms\Components\Textarea::make('deskripsi'),

                Forms\Components\FileUpload::make('logo_ekskul')
                    ->label('Logo'),

                Forms\Components\Repeater::make('jadwals')
                    ->relationship('jadwals') // ini kunci, langsung simpan ke tabel jadwals
                    ->schema([
                        Forms\Components\Select::make('hari')
                            ->options([
                                'Senin' => 'Senin',
                                'Selasa' => 'Selasa',
                                'Rabu' => 'Rabu',
                                'Kamis' => 'Kamis',
                                'Jumat' => 'Jumat',
                                'Sabtu' => 'Sabtu',
                                'Minggu' => 'Minggu',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('waktu')
                            ->label('Waktu')
                            ->placeholder('15:00 - 17:00')
                            ->required(),

                        Forms\Components\DatePicker::make('tanggal')
                            ->label('Tanggal')
                            ->native(false),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No.')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('nama_ekskul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_pembina')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jadwals')
                    ->label('Jadwal')
                    ->getStateUsing(function ($record) {
                        return $record->jadwals
                            ->map(fn($jadwal) => "{$jadwal->hari} ({$jadwal->waktu})")
                            ->implode(', ');
                    })
                    ->wrap()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('logo_ekskul')
                    ->circular()
                    ->size(50),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('hari')
                    ->label('Hari')
                    ->options([
                        'Senin' => 'Senin',
                        'Selasa' => 'Selasa',
                        'Rabu' => 'Rabu',
                        'Kamis' => 'Kamis',
                        'Jumat' => 'Jumat',
                        'Sabtu' => 'Sabtu',
                        'Minggu' => 'Minggu',
                    ])
                    ->multiple()
                    ->query(function ($query, $data) {
                        $values = collect($data)->flatten()->filter()->toArray(); // flatten array
                        if ($values) {
                            $query->whereHas('jadwals', fn($q) => $q->whereIn('hari', $values));
                        }
                    }),

            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListEkstrakurikulers::route('/'),
            'create' => Pages\CreateEkstrakurikuler::route('/create'),
            'edit' => Pages\EditEkstrakurikuler::route('/{record}/edit'),
        ];
    }
}
