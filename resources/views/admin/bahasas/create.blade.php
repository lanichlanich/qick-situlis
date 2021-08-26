@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.bahasa.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bahasas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="bahasa">{{ trans('cruds.bahasa.fields.bahasa') }}</label>
                <input class="form-control {{ $errors->has('bahasa') ? 'is-invalid' : '' }}" type="text" name="bahasa" id="bahasa" value="{{ old('bahasa', '') }}" required>
                @if($errors->has('bahasa'))
                    <span class="text-danger">{{ $errors->first('bahasa') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bahasa.fields.bahasa_helper') }}</span>
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