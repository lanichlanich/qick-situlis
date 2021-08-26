<?php

namespace App\Http\Requests;

use App\Models\TugasTambahan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTugasTambahanRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tugas_tambahan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:tugas_tambahans,id',
        ];
    }
}
