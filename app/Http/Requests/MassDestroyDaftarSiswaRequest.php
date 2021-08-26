<?php

namespace App\Http\Requests;

use App\Models\DaftarSiswa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDaftarSiswaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('daftar_siswa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:daftar_siswas,id',
        ];
    }
}
