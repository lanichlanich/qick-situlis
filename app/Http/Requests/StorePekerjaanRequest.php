<?php

namespace App\Http\Requests;

use App\Models\Pekerjaan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePekerjaanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pekerjaan_create');
    }

    public function rules()
    {
        return [
            'pekerjaan' => [
                'string',
                'required',
            ],
        ];
    }
}
