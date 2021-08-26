@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.kabupaten.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.kabupatens.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="kabupaten">{{ trans('cruds.kabupaten.fields.kabupaten') }}</label>
                <input class="form-control {{ $errors->has('kabupaten') ? 'is-invalid' : '' }}" type="text" name="kabupaten" id="kabupaten" value="{{ old('kabupaten', '') }}" required>
                @if($errors->has('kabupaten'))
                    <span class="text-danger">{{ $errors->first('kabupaten') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.kabupaten.fields.kabupaten_helper') }}</span>
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