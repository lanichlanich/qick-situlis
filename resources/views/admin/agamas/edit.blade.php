@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.agama.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.agamas.update", [$agama->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="agama">{{ trans('cruds.agama.fields.agama') }}</label>
                <input class="form-control {{ $errors->has('agama') ? 'is-invalid' : '' }}" type="text" name="agama" id="agama" value="{{ old('agama', $agama->agama) }}" required>
                @if($errors->has('agama'))
                    <span class="text-danger">{{ $errors->first('agama') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.agama.fields.agama_helper') }}</span>
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