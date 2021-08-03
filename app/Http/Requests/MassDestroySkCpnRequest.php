<?php

namespace App\Http\Requests;

use App\Models\SkCpn;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySkCpnRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sk_cpn_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sk_cpns,id',
        ];
    }
}
