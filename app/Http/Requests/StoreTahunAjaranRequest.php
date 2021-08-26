<?php

namespace App\Http\Requests;

use App\Models\TahunAjaran;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTahunAjaranRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tahun_ajaran_create');
    }

    public function rules()
    {
        return [
            'tahun_ajaran' => [
                'string',
                'required',
                'unique:tahun_ajarans',
            ],
        ];
    }
}
