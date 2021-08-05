<?php

namespace App\Http\Requests;

use App\Models\SkPengangkatanHonorer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSkPengangkatanHonorerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sk_pengangkatan_honorer_edit');
    }

    public function rules()
    {
        return [
            'no_surat' => [
                'string',
                'required',
                'unique:sk_pengangkatan_honorers,no_surat,' . request()->route('sk_pengangkatan_honorer')->id,
            ],
            'tgl_surat' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'nama_ptk_id' => [
                'required',
                'integer',
            ],
            'tmt_sk' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'masa_kerja' => [
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
            'jenis_ptk' => [
                'required',
            ],
        ];
    }
}
