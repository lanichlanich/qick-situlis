<?php

namespace App\Http\Requests;

use App\Models\PangkatGolongan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePangkatGolonganRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pangkat_golongan_create');
    }

    public function rules()
    {
        return [
            'pangkat' => [
                'string',
                'required',
            ],
            'golongan' => [
                'string',
                'required',
            ],
        ];
    }
}
