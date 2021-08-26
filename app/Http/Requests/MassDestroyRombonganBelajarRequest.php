<?php

namespace App\Http\Requests;

use App\Models\RombonganBelajar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRombonganBelajarRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('rombongan_belajar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:rombongan_belajars,id',
        ];
    }
}
