<?php

namespace App\Http\Requests;

use App\Models\SkKepangkatanPn;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySkKepangkatanPnRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sk_kepangkatan_pn_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sk_kepangkatan_pns,id',
        ];
    }
}
