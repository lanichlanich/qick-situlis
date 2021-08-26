<?php

namespace App\Http\Requests;

use App\Models\ModaTransportasi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateModaTransportasiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('moda_transportasi_edit');
    }

    public function rules()
    {
        return [
            'moda_transportasi' => [
                'string',
                'required',
            ],
        ];
    }
}
