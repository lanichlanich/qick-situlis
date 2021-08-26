<?php

namespace App\Http\Requests;

use App\Models\PendidikanTerakhir;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPendidikanTerakhirRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('pendidikan_terakhir_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:pendidikan_terakhirs,id',
        ];
    }
}
