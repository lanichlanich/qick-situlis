<?php

namespace App\Http\Requests;

use App\Models\DaftarSiswa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDaftarSiswaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('daftar_siswa_edit');
    }

    public function rules()
    {
        return [
            'no_induk' => [
                'string',
                'required',
                'unique:daftar_siswas,no_induk,' . request()->route('daftar_siswa')->id,
            ],
            'nama_siswa' => [
                'string',
                'required',
            ],
            'nisn' => [
                'string',
                'required',
                'unique:daftar_siswas,nisn,' . request()->route('daftar_siswa')->id,
            ],
            'tgl_masuk' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'asal_sekolah_id' => [
                'required',
                'integer',
            ],
            'status' => [
                'required',
            ],
            'tgl_keluar' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
