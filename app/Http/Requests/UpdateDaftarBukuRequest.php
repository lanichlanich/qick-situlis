<?php

namespace App\Http\Requests;

use App\Models\DaftarBuku;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDaftarBukuRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('daftar_buku_edit');
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
