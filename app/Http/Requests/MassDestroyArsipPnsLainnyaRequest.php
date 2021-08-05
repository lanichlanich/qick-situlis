<?php

namespace App\Http\Requests;

use App\Models\ArsipPnsLainnya;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyArsipPnsLainnyaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('arsip_pns_lainnya_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:arsip_pns_lainnyas,id',
        ];
    }
}
