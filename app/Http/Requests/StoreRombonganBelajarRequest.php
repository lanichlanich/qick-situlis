<?php

namespace App\Http\Requests;

use App\Models\RombonganBelajar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRombonganBelajarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('rombongan_belajar_create');
    }

    public function rules()
    {
        return [
            'nama_rombel' => [
                'string',
                'required',
                'unique:rombongan_belajars',
            ],
            'jurusan' => [
                'required',
            ],
        ];
    }
}
