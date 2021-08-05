<?php

namespace App\Http\Requests;

use App\Models\ArsipNpwp;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreArsipNpwpRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('arsip_npwp_create');
    }

    public function rules()
    {
        return [
            'nama_ptk_id' => [
                'required',
                'integer',
            ],
            'no_npwp' => [
                'string',
                'required',
            ],
            'kartu_npwp' => [
                'required',
            ],
        ];
    }
}
