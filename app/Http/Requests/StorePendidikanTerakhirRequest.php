<?php

namespace App\Http\Requests;

use App\Models\PendidikanTerakhir;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePendidikanTerakhirRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pendidikan_terakhir_create');
    }

    public function rules()
    {
        return [
            'pendidikan_terakhir' => [
                'string',
                'required',
            ],
        ];
    }
}
