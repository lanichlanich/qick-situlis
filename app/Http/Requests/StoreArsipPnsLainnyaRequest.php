<?php

namespace App\Http\Requests;

use App\Models\ArsipPnsLainnya;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreArsipPnsLainnyaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('arsip_pns_lainnya_create');
    }

    public function rules()
    {
        return [
            'nama_ptk_id' => [
                'required',
                'integer',
            ],
            'no_karpeg' => [
                'string',
                'nullable',
            ],
            'no_karis_karsu' => [
                'string',
                'nullable',
            ],
        ];
    }
}
