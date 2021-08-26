@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.noUrut.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.no-uruts.update", [$noUrut->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="no">{{ trans('cruds.noUrut.fields.no') }}</label>
                <input class="form-control {{ $errors->has('no') ? 'is-invalid' : '' }}" type="number" name="no" id="no" value="{{ old('no', $noUrut->no) }}" step="1" required>
                @if($errors->has('no'))
                    <span class="text-danger">{{ $errors->first('no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.noUrut.fields.no_helper') }}</span>
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