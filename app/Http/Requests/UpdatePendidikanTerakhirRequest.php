<?php

namespace App\Http\Requests;

use App\Models\PendidikanTerakhir;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePendidikanTerakhirRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pendidikan_terakhir_edit');
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
