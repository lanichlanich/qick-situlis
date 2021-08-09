<?php

namespace App\Http\Requests;

use App\Models\DaftarNamaBarang;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDaftarNamaBarangRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('daftar_nama_barang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:daftar_nama_barangs,id',
        ];
    }
}
