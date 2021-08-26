<?php

namespace App\Http\Requests;

use App\Models\PangkatGolongan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePangkatGolonganRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pangkat_golongan_edit');
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
