<?php

namespace App\Http\Requests;

use App\Models\NoUrut;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateNoUrutRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('no_urut_edit');
    }

    public function rules()
    {
        return [
            'no' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
