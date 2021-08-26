@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.penghasilan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.penghasilans.update", [$penghasilan->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="penghasilan">{{ trans('cruds.penghasilan.fields.penghasilan') }}</label>
                <input class="form-control {{ $errors->has('penghasilan') ? 'is-invalid' : '' }}" type="text" name="penghasilan" id="penghasilan" value="{{ old('penghasilan', $penghasilan->penghasilan) }}" required>
                @if($errors->has('penghasilan'))
                    <span class="text-danger">{{ $errors->first('penghasilan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.penghasilan.fields.penghasilan_helper') }}</span>
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