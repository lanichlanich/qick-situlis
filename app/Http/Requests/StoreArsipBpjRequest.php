<?php

namespace App\Http\Requests;

use App\Models\ArsipBpj;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreArsipBpjRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('arsip_bpj_create');
    }

    public function rules()
    {
        return [
            'nama_ptk_id' => [
                'required',
                'integer',
            ],
            'no_bpjs_pegawai' => [
                'string',
                'required',
            ],
            'no_bpjs_suami_istri' => [
                'string',
                'nullable',
            ],
            'no_bpjs_anak_1' => [
                'string',
                'nullable',
            ],
            'no_bpjs_anak_2' => [
                'string',
                'nullable',
            ],
            'no_bpjs_anak_3' => [
                'string',
                'nullable',
            ],
        ];
    }
}
