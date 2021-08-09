<?php

namespace App\Http\Requests;

use App\Models\DaftarNamaBarang;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDaftarNamaBarangRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('daftar_nama_barang_edit');
    }

    public function rules()
    {
        return [
            'nama_barang' => [
                'string',
                'required',
            ],
        ];
    }
}
