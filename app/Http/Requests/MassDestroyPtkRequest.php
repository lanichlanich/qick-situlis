<?php

namespace App\Http\Requests;

use App\Models\Ptk;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPtkRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('ptk_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:ptks,id',
        ];
    }
}
