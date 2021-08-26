@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.kela.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.kelas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="kelas">{{ trans('cruds.kela.fields.kelas') }}</label>
                <input class="form-control {{ $errors->has('kelas') ? 'is-invalid' : '' }}" type="text" name="kelas" id="kelas" value="{{ old('kelas', '') }}" required>
                @if($errors->has('kelas'))
                    <span class="text-danger">{{ $errors->first('kelas') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.kela.fields.kelas_helper') }}</span>
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