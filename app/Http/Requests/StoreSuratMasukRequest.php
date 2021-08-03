<?php

namespace App\Http\Requests;

use App\Models\SuratMasuk;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSuratMasukRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('surat_masuk_create');
    }

    public function rules()
    {
        return [
            'no_surat' => [
                'string',
                'required',
                'unique:surat_masuks',
            ],
            'tgl_surat' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'keterangan' => [
                'string',
                'required',
            ],
            'pengirim' => [
                'string',
                'required',
            ],
            'softfile' => [
                'required',
            ],
        ];
    }
}
