@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.modaTransportasi.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.moda-transportasis.update", [$modaTransportasi->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="moda_transportasi">{{ trans('cruds.modaTransportasi.fields.moda_transportasi') }}</label>
                <input class="form-control {{ $errors->has('moda_transportasi') ? 'is-invalid' : '' }}" type="text" name="moda_transportasi" id="moda_transportasi" value="{{ old('moda_transportasi', $modaTransportasi->moda_transportasi) }}" required>
                @if($errors->has('moda_transportasi'))
                    <span class="text-danger">{{ $errors->first('moda_transportasi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.modaTransportasi.fields.moda_transportasi_helper') }}</span>
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