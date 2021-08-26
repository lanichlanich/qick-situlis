<?php

namespace App\Http\Requests;

use App\Models\TahunAjaran;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTahunAjaranRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tahun_ajaran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:tahun_ajarans,id',
        ];
    }
}
