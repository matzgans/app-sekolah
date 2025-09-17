<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JurusanResource\Pages;
use App\Filament\Resources\JurusanResource\RelationManagers;
use App\Models\Jurusan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JurusanResource extends Resource
{
    protected static ?string $model = Jurusan::class;

    protected static ?string $navigationGroup = 'Menejemen Akademik';

    protected static ?string $navigationLabel = 'Jurusan';
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?int $navigationSort = 4;
    public static function getPluralLabel(): string
    {
        return 'Jurusan';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_jurusan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama_kepala_jurusan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('deskripsi')
                    ->required()
                    ->columnSpanFull()
                    ->rows(10),

                Forms\Components\FileUpload::make('logo_jurusan')
                    ->image()
                    ->imageEditor()
                    ->maxSize(1024)
                    ->columnSpanFull(),

                Forms\Components\Repeater::make('galeris')
                    ->label('Koleksi Gambar')
                    ->columnSpanFull()
                    ->relationship('galeris')
                    ->schema([
                        Forms\Components\FileUpload::make('gambar')
                            ->image()
                            ->required()
                            ->imageEditor()
                            ->maxSize(1024),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([
                Tables\Columns\TextColumn::make('No.')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('nama_jurusan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_kepala_jurusan')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('logo_jurusan')
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
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('lihat_galeri')
                    ->label('Lihat Galeri')
                    ->icon('heroicon-o-photo')
                    ->modalHeading('Koleksi Gambar')
                    ->modalContent(function ($record) {
                        return view('filament.prestasi.galeri-modal', [
                            'galeris' => $record->galeris,
                        ]);
                    })
                    ->modalWidth('lg')
                    ->modalSubmitAction(false),
            ])
            ->bulkActions([]);
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
            'index' => Pages\ListJurusans::route('/'),
            'create' => Pages\CreateJurusan::route('/create'),
            'edit' => Pages\EditJurusan::route('/{record}/edit'),
        ];
    }
}
