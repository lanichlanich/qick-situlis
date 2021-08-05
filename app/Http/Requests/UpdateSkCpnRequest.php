<?php

namespace App\Http\Requests;

use App\Models\SkCpn;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSkCpnRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sk_cpn_edit');
    }

    public function rules()
    {
        return [
            'no_surat' => [
                'string',
                'required',
                'unique:sk_cpns,no_surat,' . request()->route('sk_cpn')->id,
            ],
            'tgl_surat' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'nama_ptk_id' => [
                'required',
                'integer',
            ],
            'tmt_cpns' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'masa_kerja_golongan' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'masa_kerja_bulan' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'pangkat_golongan' => [
                'required',
            ],
        ];
    }
}
