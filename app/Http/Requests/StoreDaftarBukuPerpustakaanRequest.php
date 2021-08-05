<?php

namespace App\Http\Requests;

use App\Models\DaftarBukuPerpustakaan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDaftarBukuPerpustakaanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('daftar_buku_perpustakaan_create');
    }

    public function rules()
    {
        return [
            'nama_buku_id' => [
                'required',
                'integer',
            ],
            'jumlah' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'tempat_penyimpanan_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
