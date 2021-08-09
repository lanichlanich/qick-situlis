<?php

namespace App\Http\Requests;

use App\Models\DaftarRuangan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDaftarRuanganRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('daftar_ruangan_create');
    }

    public function rules()
    {
        return [
            'nama_ruangan' => [
                'string',
                'required',
            ],
            'kondisi_ruangan' => [
                'required',
            ],
        ];
    }
}
