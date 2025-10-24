<?php

namespace App\Http\Requests\Pengaduan;

use Illuminate\Foundation\Http\FormRequest;

class StorePengaduanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_lengkap' => 'required|max:255|min:3',
            'status_pengirim' => 'required|in:siswa,orang_tua,calon_siswa',
            'kontak_pengirim' => 'required',
            'subjek' => 'required|max:255|',
            'isi_pesan' => 'required',
            'kategori_pengaduan' => 'required',
            'jenis_pengaduan' => 'required',
            'file_pengaduan' => 'nullable|file|mimes:pdf,jpg,jpeg,png,ppt,pptx|max:2048',
        ];
    }


    public function messages(): array
    {
        return [
            'nama_lengkap.required' => 'Nama Lengkap harus diisi',
            'nama_lengkap.max' => 'Nama Lengkap maksimal 255 karakter',
            'nama_lengkap.min' => 'Nama Lengkap minimal 3 karakter',
            'status_pengirim.required' => 'Status Pengirim harus diisi',
            'status_pengirim.in' => 'Status Pengirim harus diisi dengan siswa, orang tua, atau calon siswa',
            'kontak_pengirim.required' => 'Kontak Pengirim harus diisi',
            'subjek.required' => 'Subjek harus diisi',
            'subjek.max' => 'Subjek maksimal 255 karakter',
            'isi_pesan.required' => 'Isi Pesan harus diisi',
            'file_pengaduan.file' => 'File Pengaduan harus diisi',
            'file_pengaduan.mimes' => 'File Pengaduan harus diisi dengan pdf, jpg, jpeg, png, ppt, atau pptx',
            'file_pengaduan.max' => 'File Pengaduan maksimal 2MB',

        ];
    }
}
