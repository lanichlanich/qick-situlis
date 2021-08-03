<?php

namespace App\Http\Requests;

use App\Models\SuratMasuk;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySuratMasukRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('surat_masuk_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:surat_masuks,id',
        ];
    }
}
