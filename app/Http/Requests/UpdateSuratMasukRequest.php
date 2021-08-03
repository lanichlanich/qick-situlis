<?php

namespace App\Http\Requests;

use App\Models\SuratMasuk;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSuratMasukRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('surat_masuk_edit');
    }

    public function rules()
    {
        return [
            'no_surat' => [
                'string',
                'required',
                'unique:surat_masuks,no_surat,' . request()->route('surat_masuk')->id,
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
        ];
    }
}
