@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.ptk.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ptks.update", [$ptk->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nama_lengkap">{{ trans('cruds.ptk.fields.nama_lengkap') }}</label>
                <input class="form-control {{ $errors->has('nama_lengkap') ? 'is-invalid' : '' }}" type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', $ptk->nama_lengkap) }}" required>
                @if($errors->has('nama_lengkap'))
                    <span class="text-danger">{{ $errors->first('nama_lengkap') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ptk.fields.nama_lengkap_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection