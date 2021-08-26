@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.tahun.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tahuns.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="tahun">{{ trans('cruds.tahun.fields.tahun') }}</label>
                <input class="form-control {{ $errors->has('tahun') ? 'is-invalid' : '' }}" type="number" name="tahun" id="tahun" value="{{ old('tahun', '') }}" step="1">
                @if($errors->has('tahun'))
                    <span class="text-danger">{{ $errors->first('tahun') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tahun.fields.tahun_helper') }}</span>
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