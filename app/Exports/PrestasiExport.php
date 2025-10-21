<?php

namespace App\Exports;

use App\Models\Prestasi; // Diperlukan untuk type-hinting di 'map'
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PrestasiExport implements FromQuery, WithHeadings, WithMapping
{
    protected $query;

    // 1. Terima query yang sudah difilter melalui constructor
    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    // 2. Gunakan query yang diterima untuk mengambil data
    public function query()
    {
        return $this->query;
    }

    // 3. Tentukan judul kolom (headings) untuk file Excel
    public function headings(): array
    {
        return [
            'Judul Lomba',
            'Nama Siswa',
            'Guru Pembimbing',
            'Jenis Prestasi',
            'Tingkat',
            'Tahun',
            'Deskripsi',
            'Tanggal Input',
        ];
    }

    // 4. Tentukan data apa saja yang ingin ditampilkan di tiap baris
    /**
     * @param Prestasi $prestasi
     */
    public function map($prestasi): array
    {
        return [
            $prestasi->judul,
            $prestasi->nama_siswa,
            $prestasi->nama_guru_pembimbing,
            $prestasi->jenis_prestasi,
            $prestasi->tingkat,
            $prestasi->tahun,
            $prestasi->deskripsi,
            $prestasi->created_at->format('Y-m-d H:i:s'), // Format tanggal
        ];
    }
}
