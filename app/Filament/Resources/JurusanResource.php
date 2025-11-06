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
use Filament\Forms\Components\Alert;

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
                // Field-field ini dari kode Anda, sudah benar
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

                Forms\Components\Section::make('Definisi Opsi Kurikulum')
                    ->description('Tentukan opsi yang akan muncul di dropdown saat mengisi kurikulum.')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Repeater::make('kelompok_options')
                            ->label('Opsi Kelompok Mata Pelajaran')
                            ->schema([
                                Forms\Components\TextInput::make('nama_kelompok')
                                    ->label('Nama Kelompok')
                                    // Beri petunjuk di sini juga
                                    ->helperText('Cth: "A - Muatan Nasional", "B - Muatan Kewilayahan", "C - Muatan Peminatan Kejuruan"')
                                    ->required(),
                            ])
                            ->defaultItems(3)
                            ->addActionLabel('Tambah Opsi Kelompok'),

                        // === INI INFO YANG ANDA MAKSUD ===
                        Forms\Components\Placeholder::make('info_peminatan')
                            ->label('') // Kosongkan label
                            ->content('Opsi di bawah ini (Sub-Kelompok) hanya akan digunakan jika Anda menginput Mata Pelajaran yang termasuk dalam Kelompok C (Peminatan Kejuruan).'),
                        // === AKHIR DARI INFO ===

                        Forms\Components\Repeater::make('sub_kelompok_options')
                            ->label('Opsi Sub-Kelompok (Peminatan)')
                            ->schema([
                                Forms\Components\TextInput::make('nama_sub_kelompok')
                                    ->label('Nama Sub-Kelompok')
                                    ->helperText('Cth: "C1. Dasar Bidang Keahlian", "C2. Dasar Program Keahlian", "C3. Kompetensi Keahlian"')
                                    ->required(),
                            ])
                            ->defaultItems(3)
                            ->addActionLabel('Tambah Opsi Sub-Kelompok'),
                    ])->columnSpanFull(),

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

            ])
            // ->filters([])
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
            RelationManagers\MataPelajaranRelationManager::class,
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
