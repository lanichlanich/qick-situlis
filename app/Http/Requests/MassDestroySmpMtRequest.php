<?php

namespace App\Http\Requests;

use App\Models\SmpMt;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySmpMtRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('smp_mt_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:smp_mts,id',
        ];
    }
}
