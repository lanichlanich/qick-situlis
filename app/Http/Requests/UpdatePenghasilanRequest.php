<?php

namespace App\Http\Requests;

use App\Models\Penghasilan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePenghasilanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('penghasilan_edit');
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
