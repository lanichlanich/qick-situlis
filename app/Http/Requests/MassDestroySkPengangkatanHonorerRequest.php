<?php

namespace App\Http\Requests;

use App\Models\SkPengangkatanHonorer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySkPengangkatanHonorerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sk_pengangkatan_honorer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sk_pengangkatan_honorers,id',
        ];
    }
}
