@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.pendidikanTerakhir.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.pendidikan-terakhirs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="pendidikan_terakhir">{{ trans('cruds.pendidikanTerakhir.fields.pendidikan_terakhir') }}</label>
                <input class="form-control {{ $errors->has('pendidikan_terakhir') ? 'is-invalid' : '' }}" type="text" name="pendidikan_terakhir" id="pendidikan_terakhir" value="{{ old('pendidikan_terakhir', '') }}" required>
                @if($errors->has('pendidikan_terakhir'))
                    <span class="text-danger">{{ $errors->first('pendidikan_terakhir') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pendidikanTerakhir.fields.pendidikan_terakhir_helper') }}</span>
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