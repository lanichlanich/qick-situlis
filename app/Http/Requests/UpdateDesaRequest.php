<?php

namespace App\Http\Requests;

use App\Models\Desa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDesaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('desa_edit');
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
