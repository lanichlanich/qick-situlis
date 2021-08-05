<?php

namespace App\Http\Requests;

use App\Models\TempatPenyimpananBuku;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTempatPenyimpananBukuRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tempat_penyimpanan_buku_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:tempat_penyimpanan_bukus,id',
        ];
    }
}
