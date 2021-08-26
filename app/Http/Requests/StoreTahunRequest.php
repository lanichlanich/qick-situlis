<?php

namespace App\Http\Requests;

use App\Models\Tahun;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTahunRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tahun_create');
    }

    public function rules()
    {
        return [
            'tahun' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
