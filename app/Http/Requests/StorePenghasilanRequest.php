<?php

namespace App\Http\Requests;

use App\Models\Penghasilan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePenghasilanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('penghasilan_create');
    }

    public function rules()
    {
        return [
            'penghasilan' => [
                'string',
                'required',
            ],
        ];
    }
}
