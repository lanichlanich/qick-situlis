<?php

namespace App\Http\Requests;

use App\Models\PeminjamanBuku;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePeminjamanBukuRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('peminjaman_buku_create');
    }

    public function rules()
    {
        return [
            'peminjam_buku_id' => [
                'required',
                'integer',
            ],
            'nama_buku_id' => [
                'required',
                'integer',
            ],
            'tempat_penyimpanan_buku_id' => [
                'required',
                'integer',
            ],
            'jumlah_pinjam' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'tanggal_pinjam' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'tanggal_pengembalian' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
