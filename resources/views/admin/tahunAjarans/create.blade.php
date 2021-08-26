@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.tahunAjaran.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tahun-ajarans.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="tahun_ajaran">{{ trans('cruds.tahunAjaran.fields.tahun_ajaran') }}</label>
                <input class="form-control {{ $errors->has('tahun_ajaran') ? 'is-invalid' : '' }}" type="text" name="tahun_ajaran" id="tahun_ajaran" value="{{ old('tahun_ajaran', '') }}" required>
                @if($errors->has('tahun_ajaran'))
                    <span class="text-danger">{{ $errors->first('tahun_ajaran') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tahunAjaran.fields.tahun_ajaran_helper') }}</span>
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