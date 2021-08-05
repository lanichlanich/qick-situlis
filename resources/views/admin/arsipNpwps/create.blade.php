@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.arsipNpwp.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.arsip-npwps.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nama_ptk_id">{{ trans('cruds.arsipNpwp.fields.nama_ptk') }}</label>
                <select class="form-control select2 {{ $errors->has('nama_ptk') ? 'is-invalid' : '' }}" name="nama_ptk_id" id="nama_ptk_id" required>
                    @foreach($nama_ptks as $id => $entry)
                        <option value="{{ $id }}" {{ old('nama_ptk_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('nama_ptk'))
                    <span class="text-danger">{{ $errors->first('nama_ptk') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipNpwp.fields.nama_ptk_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="no_npwp">{{ trans('cruds.arsipNpwp.fields.no_npwp') }}</label>
                <input class="form-control {{ $errors->has('no_npwp') ? 'is-invalid' : '' }}" type="text" name="no_npwp" id="no_npwp" value="{{ old('no_npwp', '') }}" required>
                @if($errors->has('no_npwp'))
                    <span class="text-danger">{{ $errors->first('no_npwp') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipNpwp.fields.no_npwp_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="kartu_npwp">{{ trans('cruds.arsipNpwp.fields.kartu_npwp') }}</label>
                <div class="needsclick dropzone {{ $errors->has('kartu_npwp') ? 'is-invalid' : '' }}" id="kartu_npwp-dropzone">
                </div>
                @if($errors->has('kartu_npwp'))
                    <span class="text-danger">{{ $errors->first('kartu_npwp') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipNpwp.fields.kartu_npwp_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.kartuNpwpDropzone = {
    url: '{{ route('admin.arsip-npwps.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="kartu_npwp"]').remove()
      $('form').append('<input type="hidden" name="kartu_npwp" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="kartu_npwp"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($arsipNpwp) && $arsipNpwp->kartu_npwp)
      var file = {!! json_encode($arsipNpwp->kartu_npwp) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="kartu_npwp" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection