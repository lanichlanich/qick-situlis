<?php

namespace App\Http\Requests;

use App\Models\PeminjamanBuku;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPeminjamanBukuRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('peminjaman_buku_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:peminjaman_bukus,id',
        ];
    }
}
