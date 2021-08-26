<?php

namespace App\Http\Requests;

use App\Models\RombonganBelajar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRombonganBelajarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('rombongan_belajar_edit');
    }

    public function rules()
    {
        return [
            'nama_rombel' => [
                'string',
                'required',
                'unique:rombongan_belajars,nama_rombel,' . request()->route('rombongan_belajar')->id,
            ],
            'jurusan' => [
                'required',
            ],
        ];
    }
}
