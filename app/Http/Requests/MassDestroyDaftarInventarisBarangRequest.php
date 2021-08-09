<?php

namespace App\Http\Requests;

use App\Models\DaftarInventarisBarang;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDaftarInventarisBarangRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('daftar_inventaris_barang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:daftar_inventaris_barangs,id',
        ];
    }
}
