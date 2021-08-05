<?php

namespace App\Http\Requests;

use App\Models\DaftarBuku;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDaftarBukuRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('daftar_buku_create');
    }

    public function rules()
    {
        return [
            'nama_buku' => [
                'string',
                'required',
            ],
        ];
    }
}
