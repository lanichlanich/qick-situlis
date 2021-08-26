<?php

namespace App\Http\Requests;

use App\Models\Kela;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreKelaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('kela_create');
    }

    public function rules()
    {
        return [
            'kelas' => [
                'string',
                'required',
            ],
        ];
    }
}
