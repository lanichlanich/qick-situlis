<?php

namespace App\Http\Requests;

use App\Models\Agama;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAgamaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('agama_edit');
    }

    public function rules()
    {
        return [
            'agama' => [
                'string',
                'required',
            ],
        ];
    }
}
