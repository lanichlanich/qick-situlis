<?php

namespace App\Http\Requests;

use App\Models\ArsipBpj;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyArsipBpjRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('arsip_bpj_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:arsip_bpjs,id',
        ];
    }
}
