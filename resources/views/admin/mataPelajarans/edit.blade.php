@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.mataPelajaran.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.mata-pelajarans.update", [$mataPelajaran->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="mata_pelajararan">{{ trans('cruds.mataPelajaran.fields.mata_pelajararan') }}</label>
                <input class="form-control {{ $errors->has('mata_pelajararan') ? 'is-invalid' : '' }}" type="text" name="mata_pelajararan" id="mata_pelajararan" value="{{ old('mata_pelajararan', $mataPelajaran->mata_pelajararan) }}" required>
                @if($errors->has('mata_pelajararan'))
                    <span class="text-danger">{{ $errors->first('mata_pelajararan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mataPelajaran.fields.mata_pelajararan_helper') }}</span>
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