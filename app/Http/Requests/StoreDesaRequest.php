<?php

namespace App\Http\Requests;

use App\Models\Desa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDesaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('desa_create');
    }

    public function rules()
    {
        return [
            'desa' => [
                'string',
                'required',
            ],
        ];
    }
}
