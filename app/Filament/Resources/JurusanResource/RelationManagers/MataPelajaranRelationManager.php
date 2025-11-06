<?php

namespace App\Filament\Resources\JurusanResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MataPelajaranRelationManager extends RelationManager
{
    protected static string $relationship = 'mataPelajaran';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kelompok')
                    ->label('Kelompok Mata Pelajaran')
                    ->options(function (RelationManager $livewire): array {
                        $jurusan = $livewire->getOwnerRecord();
                        if (!$jurusan->kelompok_options) {
                            return ['' => 'Harap isi Opsi Kelompok di Form Jurusan'];
                        }
                        return collect($jurusan->kelompok_options)
                            ->pluck('nama_kelompok', 'nama_kelompok')
                            ->all();
                    })
                    ->required()
                    ->reactive(),

                Forms\Components\Select::make('sub_kelompok')
                    ->label('Sub-Kelompok Mata Pelajaran')
                    ->options(function (RelationManager $livewire): array {
                        $jurusan = $livewire->getOwnerRecord();
                        if (!$jurusan->sub_kelompok_options) {
                            return ['' => 'Harap isi Opsi Sub-Kelompok di Form Jurusan'];
                        }
                        return collect($jurusan->sub_kelompok_options)
                            ->pluck('nama_sub_kelompok', 'nama_sub_kelompok')
                            ->all();
                    })
                    ->visible(fn(callable $get) => $get('kelompok') && str_starts_with($get('kelompok'), 'C')),

                Forms\Components\TextInput::make('nama_mapel')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                Forms\Components\Select::make('tingkat')
                    ->options([
                        'X' => 'Kelas X',
                        'XI' => 'Kelas XI',
                        'XII' => 'Kelas XII',
                    ])
                    ->required(),

                Forms\Components\Select::make('semester')
                    ->options([
                        'Ganjil' => 'Semester Ganjil',
                        'Genap' => 'Semester Genap',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('kode_mapel')
                    ->maxLength(50),

                Forms\Components\TextInput::make('alokasi_waktu_jp')
                    ->numeric()
                    ->label('Alokasi Waktu (Jam Pelajaran)'),

                Forms\Components\Repeater::make('kompetensi_dasar')
                    ->label('Kompetensi Dasar (KD) / Capaian Pembelajaran (CP)')
                    ->schema([
                        Forms\Components\TextInput::make('kode')->label('Kode KD/CP')->columnSpan(1),
                        Forms\Components\TextInput::make('deskripsi')->label('Deskripsi Kompetensi')->columnSpan(3),
                    ])
                    ->columns(4)
                    ->columnSpanFull()
                    ->collapsible()
                    ->defaultItems(1),

                Forms\Components\TextInput::make('urutan')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama_mapel')
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Tambah Mata Pelajaran'),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('urutan')->sortable(),
                Tables\Columns\TextColumn::make('nama_mapel')->searchable(),
                Tables\Columns\TextColumn::make('kelompok')->badge(),
                Tables\Columns\TextColumn::make('tingkat')->badge(),
                Tables\Columns\TextColumn::make('semester')->badge(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tingkat')
                    ->options([
                        'X' => 'Kelas X',
                        'XI' => 'Kelas XI',
                        'XII' => 'Kelas XII',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->reorderable('urutan')
            ->defaultGroup('kelompok');
    }
}
