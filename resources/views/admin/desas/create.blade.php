@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.desa.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.desas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="desa">{{ trans('cruds.desa.fields.desa') }}</label>
                <input class="form-control {{ $errors->has('desa') ? 'is-invalid' : '' }}" type="text" name="desa" id="desa" value="{{ old('desa', '') }}" required>
                @if($errors->has('desa'))
                    <span class="text-danger">{{ $errors->first('desa') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.desa.fields.desa_helper') }}</span>
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