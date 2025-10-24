<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaduanResource\Pages;
use App\Models\Pengaduan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PengaduanResource extends Resource
{
    protected static ?string $model = Pengaduan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen Pengaduan';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_lengkap')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status_pengirim')
                    ->required()
                    ->options([
                        'siswa' => 'Siswa',
                        'orang_tua' => 'Orang Tua',
                        'calon_siswa' => 'Calon Siswa',
                    ]),
                Forms\Components\TextInput::make('kontak_pengirim')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('subjek')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('isi_pesan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('kategori_pengaduan')
                    ->required()
                    ->options([
                        'ekstrakurikuler' => 'Ekstrakurikuler',
                        'guru' => 'Guru',
                        'fasilitas' => 'Fasilitas',
                        'prestasi' => 'Prestasi',
                        'galeri' => 'Galeri',
                        'pengumuman' => 'Pengumuman',
                        'berita' => 'Berita',
                        'jurusan' => 'Jurusan',
                        'lainnya' => 'Lainnya',
                    ]),
                Forms\Components\Select::make('jenis_pengaduan')
                    ->required()
                    ->options([
                        'saran' => 'Saran',
                        'pertanyaan' => 'Pertanyaan',
                        'pengaduan' => 'Pengaduan',
                    ]),
                Forms\Components\FileUpload::make('file_pengaduan')
                    ->maxSize(1024),
                Forms\Components\Select::make('status_tiket')
                    ->required()
                    ->options([
                        'pending' => 'Pending',
                        'proses' => 'Proses',
                        'selesai' => 'Selesai',
                        'ditolak' => 'Ditolak',
                    ]),
                Forms\Components\TextInput::make('no_tiket')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_pengaduan')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_tanggapan')
                    ->required(),
                Forms\Components\TextInput::make('alasan_ditolak')
                    ->maxLength(255),
                Forms\Components\Select::make('user_id')
                    ->required()
                    ->relationship('user', 'name'),
                Forms\Components\Textarea::make('tanggapan')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_lengkap')->searchable(),
                Tables\Columns\TextColumn::make('status_pengirim'),
                Tables\Columns\TextColumn::make('kontak_pengirim'),
                Tables\Columns\TextColumn::make('subjek'),
                Tables\Columns\TextColumn::make('isi_pesan'),
                Tables\Columns\TextColumn::make('kategori_pengaduan'),
                Tables\Columns\ImageColumn::make('file_pengaduan')
                    ->label('Bukti')
                    ->disk('public') // <-- Biarkan ini
                    // ->getStateUsing(fn($record) => asset($record->file_pengaduan)) // <-- Hapus baris ini
                    ->extraAttributes([
                        'class' => 'cursor-pointer transition hover:opacity-80',
                        'onclick' => "window.open(this.src, '_blank')"
                    ]),

                Tables\Columns\TextColumn::make('status_tiket'),
                Tables\Columns\TextColumn::make('no_tiket'),
                Tables\Columns\TextColumn::make('tanggal_pengaduan'),
                Tables\Columns\TextColumn::make('tanggal_tanggapan'),
                Tables\Columns\TextColumn::make('alasan_ditolak'),
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
            'index' => Pages\ListPengaduans::route('/'),
            'create' => Pages\CreatePengaduan::route('/create'),
            'edit' => Pages\EditPengaduan::route('/{record}/edit'),
        ];
    }
}
