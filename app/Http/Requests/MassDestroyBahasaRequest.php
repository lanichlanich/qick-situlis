<?php

namespace App\Http\Requests;

use App\Models\Bahasa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBahasaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('bahasa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:bahasas,id',
        ];
    }
}
