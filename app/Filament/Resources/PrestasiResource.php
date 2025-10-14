<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrestasiResource\Pages;
use App\Filament\Resources\PrestasiResource\RelationManagers;
use App\Models\Prestasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PrestasiResource extends Resource
{
    protected static ?string $model = Prestasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $navigationGroup = 'Menejemen Kesiswaan';
    protected static ?string $navigationLabel = 'Prestasi';
    protected static ?int $navigationSort = 5;
    public static function getPluralLabel(): string
    {
        return 'Prestasi';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('deskripsi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('tingkat')
                    ->required()
                    ->options([
                        'sekolah' => 'Sekolah',
                        'kota' => 'Kota',
                        'provinsi' => 'Provinsi',
                        'nasional' => 'Nasional',
                        'internasional' => 'Internasional',
                    ]),
                Forms\Components\TextInput::make('tahun')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('thumbnail')
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
                Tables\Columns\TextColumn::make('judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tingkat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tahun')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->circular()
                    ->size(50),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tingkat')
                    ->options([
                        'sekolah' => 'Sekolah',
                        'kota' => 'Kota',
                        'provinsi' => 'Provinsi',
                        'nasional' => 'Nasional',
                        'internasional' => 'Internasional',
                    ]),
                Tables\Filters\SelectFilter::make('tahun')
                    ->options(Prestasi::all()->pluck('tahun', 'tahun')),
            ])
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
            ->bulkActions([
                //
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
            'index' => Pages\ListPrestasis::route('/'),
            'create' => Pages\CreatePrestasi::route('/create'),
            'edit' => Pages\EditPrestasi::route('/{record}/edit'),
        ];
    }
}
