<?php

namespace App\Http\Requests;

use App\Models\TugasTambahan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTugasTambahanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tugas_tambahan_edit');
    }

    public function rules()
    {
        return [
            'tugas_tambahan' => [
                'string',
                'required',
            ],
        ];
    }
}
