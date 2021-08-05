<?php

namespace App\Http\Requests;

use App\Models\ArsipKependudukan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreArsipKependudukanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('arsip_kependudukan_create');
    }

    public function rules()
    {
        return [
            'nama_ptk_id' => [
                'required',
                'integer',
            ],
            'no_nik' => [
                'string',
                'required',
            ],
            'no_kk' => [
                'string',
                'nullable',
            ],
        ];
    }
}
