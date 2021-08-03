<?php

namespace App\Http\Requests;

use App\Models\SuratKeluar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSuratKeluarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('surat_keluar_create');
    }

    public function rules()
    {
        return [
            'no_surat' => [
                'string',
                'required',
                'unique:surat_keluars',
            ],
            'tgl_surat' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'keterangan' => [
                'string',
                'required',
            ],
            'tujuan' => [
                'string',
                'required',
            ],
            'softfile' => [
                'required',
            ],
        ];
    }
}
