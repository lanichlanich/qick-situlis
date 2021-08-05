@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.arsipKependudukan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.arsip-kependudukans.update", [$arsipKependudukan->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nama_ptk_id">{{ trans('cruds.arsipKependudukan.fields.nama_ptk') }}</label>
                <select class="form-control select2 {{ $errors->has('nama_ptk') ? 'is-invalid' : '' }}" name="nama_ptk_id" id="nama_ptk_id" required>
                    @foreach($nama_ptks as $id => $entry)
                        <option value="{{ $id }}" {{ (old('nama_ptk_id') ? old('nama_ptk_id') : $arsipKependudukan->nama_ptk->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('nama_ptk'))
                    <span class="text-danger">{{ $errors->first('nama_ptk') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipKependudukan.fields.nama_ptk_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="no_nik">{{ trans('cruds.arsipKependudukan.fields.no_nik') }}</label>
                <input class="form-control {{ $errors->has('no_nik') ? 'is-invalid' : '' }}" type="text" name="no_nik" id="no_nik" value="{{ old('no_nik', $arsipKependudukan->no_nik) }}" required>
                @if($errors->has('no_nik'))
                    <span class="text-danger">{{ $errors->first('no_nik') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipKependudukan.fields.no_nik_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ktp">{{ trans('cruds.arsipKependudukan.fields.ktp') }}</label>
                <div class="needsclick dropzone {{ $errors->has('ktp') ? 'is-invalid' : '' }}" id="ktp-dropzone">
                </div>
                @if($errors->has('ktp'))
                    <span class="text-danger">{{ $errors->first('ktp') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipKependudukan.fields.ktp_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_kk">{{ trans('cruds.arsipKependudukan.fields.no_kk') }}</label>
                <input class="form-control {{ $errors->has('no_kk') ? 'is-invalid' : '' }}" type="text" name="no_kk" id="no_kk" value="{{ old('no_kk', $arsipKependudukan->no_kk) }}">
                @if($errors->has('no_kk'))
                    <span class="text-danger">{{ $errors->first('no_kk') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipKependudukan.fields.no_kk_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kartu_keluarga">{{ trans('cruds.arsipKependudukan.fields.kartu_keluarga') }}</label>
                <div class="needsclick dropzone {{ $errors->has('kartu_keluarga') ? 'is-invalid' : '' }}" id="kartu_keluarga-dropzone">
                </div>
                @if($errors->has('kartu_keluarga'))
                    <span class="text-danger">{{ $errors->first('kartu_keluarga') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipKependudukan.fields.kartu_keluarga_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="akta_lahir">{{ trans('cruds.arsipKependudukan.fields.akta_lahir') }}</label>
                <div class="needsclick dropzone {{ $errors->has('akta_lahir') ? 'is-invalid' : '' }}" id="akta_lahir-dropzone">
                </div>
                @if($errors->has('akta_lahir'))
                    <span class="text-danger">{{ $errors->first('akta_lahir') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipKependudukan.fields.akta_lahir_helper') }}</span>
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
    Dropzone.options.ktpDropzone = {
    url: '{{ route('admin.arsip-kependudukans.storeMedia') }}',
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
      $('form').find('input[name="ktp"]').remove()
      $('form').append('<input type="hidden" name="ktp" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="ktp"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($arsipKependudukan) && $arsipKependudukan->ktp)
      var file = {!! json_encode($arsipKependudukan->ktp) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="ktp" value="' + file.file_name + '">')
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
<script>
    Dropzone.options.kartuKeluargaDropzone = {
    url: '{{ route('admin.arsip-kependudukans.storeMedia') }}',
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
      $('form').find('input[name="kartu_keluarga"]').remove()
      $('form').append('<input type="hidden" name="kartu_keluarga" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="kartu_keluarga"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($arsipKependudukan) && $arsipKependudukan->kartu_keluarga)
      var file = {!! json_encode($arsipKependudukan->kartu_keluarga) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="kartu_keluarga" value="' + file.file_name + '">')
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
<script>
    Dropzone.options.aktaLahirDropzone = {
    url: '{{ route('admin.arsip-kependudukans.storeMedia') }}',
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
      $('form').find('input[name="akta_lahir"]').remove()
      $('form').append('<input type="hidden" name="akta_lahir" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="akta_lahir"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($arsipKependudukan) && $arsipKependudukan->akta_lahir)
      var file = {!! json_encode($arsipKependudukan->akta_lahir) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="akta_lahir" value="' + file.file_name + '">')
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