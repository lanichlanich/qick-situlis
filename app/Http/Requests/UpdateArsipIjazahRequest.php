<?php

namespace App\Http\Requests;

use App\Models\ArsipIjazah;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateArsipIjazahRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('arsip_ijazah_edit');
    }

    public function rules()
    {
        return [
            'nama_ptk_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
