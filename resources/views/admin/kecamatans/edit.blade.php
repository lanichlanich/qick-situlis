@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.kecamatan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.kecamatans.update", [$kecamatan->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="kecamatan">{{ trans('cruds.kecamatan.fields.kecamatan') }}</label>
                <input class="form-control {{ $errors->has('kecamatan') ? 'is-invalid' : '' }}" type="text" name="kecamatan" id="kecamatan" value="{{ old('kecamatan', $kecamatan->kecamatan) }}" required>
                @if($errors->has('kecamatan'))
                    <span class="text-danger">{{ $errors->first('kecamatan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.kecamatan.fields.kecamatan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="kode_post">{{ trans('cruds.kecamatan.fields.kode_post') }}</label>
                <input class="form-control {{ $errors->has('kode_post') ? 'is-invalid' : '' }}" type="text" name="kode_post" id="kode_post" value="{{ old('kode_post', $kecamatan->kode_post) }}" required>
                @if($errors->has('kode_post'))
                    <span class="text-danger">{{ $errors->first('kode_post') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.kecamatan.fields.kode_post_helper') }}</span>
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