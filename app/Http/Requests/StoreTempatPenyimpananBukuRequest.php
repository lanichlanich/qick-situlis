<?php

namespace App\Http\Requests;

use App\Models\TempatPenyimpananBuku;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTempatPenyimpananBukuRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tempat_penyimpanan_buku_create');
    }

    public function rules()
    {
        return [
            'nama_tempat_penyimpaanan' => [
                'string',
                'required',
            ],
        ];
    }
}
