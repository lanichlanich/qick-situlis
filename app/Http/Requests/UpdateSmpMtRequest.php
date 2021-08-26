<?php

namespace App\Http\Requests;

use App\Models\SmpMt;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSmpMtRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('smp_mt_edit');
    }

    public function rules()
    {
        return [
            'smp_mts' => [
                'string',
                'required',
            ],
        ];
    }
}
