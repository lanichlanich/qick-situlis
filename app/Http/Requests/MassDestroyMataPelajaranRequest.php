<?php

namespace App\Http\Requests;

use App\Models\MataPelajaran;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMataPelajaranRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('mata_pelajaran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:mata_pelajarans,id',
        ];
    }
}
