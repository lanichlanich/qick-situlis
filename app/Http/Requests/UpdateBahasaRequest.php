<?php

namespace App\Http\Requests;

use App\Models\Bahasa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBahasaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bahasa_edit');
    }

    public function rules()
    {
        return [
            'bahasa' => [
                'string',
                'required',
            ],
        ];
    }
}
