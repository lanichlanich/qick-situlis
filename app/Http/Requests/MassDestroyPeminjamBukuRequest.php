<?php

namespace App\Http\Requests;

use App\Models\PeminjamBuku;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPeminjamBukuRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('peminjam_buku_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:peminjam_bukus,id',
        ];
    }
}
