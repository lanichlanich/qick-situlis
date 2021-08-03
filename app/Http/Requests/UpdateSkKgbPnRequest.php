<?php

namespace App\Http\Requests;

use App\Models\SkKgbPn;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSkKgbPnRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sk_kgb_pn_edit');
    }

    public function rules()
    {
        return [
            'no_surat' => [
                'string',
                'required',
                'unique:sk_kgb_pns,no_surat,' . request()->route('sk_kgb_pn')->id,
            ],
            'tgl_surat' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'nama_ptk_id' => [
                'required',
                'integer',
            ],
            'tmt_kgb' => [
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
        ];
    }
}
