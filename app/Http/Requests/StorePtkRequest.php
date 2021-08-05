<?php

namespace App\Http\Requests;

use App\Models\Ptk;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePtkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ptk_create');
    }

    public function rules()
    {
        return [
            'nama_lengkap' => [
                'string',
                'required',
            ],
        ];
    }
}
