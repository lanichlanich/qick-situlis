<?php

namespace App\Http\Requests;

use App\Models\SuratKeluar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySuratKeluarRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('surat_keluar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:surat_keluars,id',
        ];
    }
}
