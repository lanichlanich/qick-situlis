<?php

namespace App\Http\Requests;

use App\Models\PeminjamBuku;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePeminjamBukuRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('peminjam_buku_create');
    }

    public function rules()
    {
        return [
            'nama_peminjam' => [
                'string',
                'required',
            ],
        ];
    }
}
