<?php

namespace App\Http\Requests;

use App\Models\MataPelajaran;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMataPelajaranRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('mata_pelajaran_create');
    }

    public function rules()
    {
        return [
            'mata_pelajararan' => [
                'string',
                'required',
            ],
        ];
    }
}
