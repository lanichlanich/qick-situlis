<?php

namespace App\Http\Requests;

use App\Models\DaftarInventarisBarang;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDaftarInventarisBarangRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('daftar_inventaris_barang_edit');
    }

    public function rules()
    {
        return [
            'nama_barang_id' => [
                'required',
                'integer',
            ],
            'jumlah' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'daftar_ruangan_id' => [
                'required',
                'integer',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
