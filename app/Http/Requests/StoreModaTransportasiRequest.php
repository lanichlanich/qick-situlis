<?php

namespace App\Http\Requests;

use App\Models\ModaTransportasi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreModaTransportasiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('moda_transportasi_create');
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
