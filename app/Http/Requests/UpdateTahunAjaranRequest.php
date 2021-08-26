<?php

namespace App\Http\Requests;

use App\Models\TahunAjaran;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTahunAjaranRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tahun_ajaran_edit');
    }

    public function rules()
    {
        return [
            'tahun_ajaran' => [
                'string',
                'required',
                'unique:tahun_ajarans,tahun_ajaran,' . request()->route('tahun_ajaran')->id,
            ],
        ];
    }
}
