<?php

namespace App\Http\Requests;

use App\Models\Kabupaten;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateKabupatenRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('kabupaten_edit');
    }

    public function rules()
    {
        return [
            'kabupaten' => [
                'string',
                'required',
            ],
        ];
    }
}
