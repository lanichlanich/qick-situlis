@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.arsipIjazah.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.arsip-ijazahs.update", [$arsipIjazah->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nama_ptk_id">{{ trans('cruds.arsipIjazah.fields.nama_ptk') }}</label>
                <select class="form-control select2 {{ $errors->has('nama_ptk') ? 'is-invalid' : '' }}" name="nama_ptk_id" id="nama_ptk_id" required>
                    @foreach($nama_ptks as $id => $entry)
                        <option value="{{ $id }}" {{ (old('nama_ptk_id') ? old('nama_ptk_id') : $arsipIjazah->nama_ptk->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('nama_ptk'))
                    <span class="text-danger">{{ $errors->first('nama_ptk') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipIjazah.fields.nama_ptk_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sd">{{ trans('cruds.arsipIjazah.fields.sd') }}</label>
                <div class="needsclick dropzone {{ $errors->has('sd') ? 'is-invalid' : '' }}" id="sd-dropzone">
                </div>
                @if($errors->has('sd'))
                    <span class="text-danger">{{ $errors->first('sd') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipIjazah.fields.sd_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="smp_mts">{{ trans('cruds.arsipIjazah.fields.smp_mts') }}</label>
                <div class="needsclick dropzone {{ $errors->has('smp_mts') ? 'is-invalid' : '' }}" id="smp_mts-dropzone">
                </div>
                @if($errors->has('smp_mts'))
                    <span class="text-danger">{{ $errors->first('smp_mts') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipIjazah.fields.smp_mts_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sma_smk_ma">{{ trans('cruds.arsipIjazah.fields.sma_smk_ma') }}</label>
                <div class="needsclick dropzone {{ $errors->has('sma_smk_ma') ? 'is-invalid' : '' }}" id="sma_smk_ma-dropzone">
                </div>
                @if($errors->has('sma_smk_ma'))
                    <span class="text-danger">{{ $errors->first('sma_smk_ma') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipIjazah.fields.sma_smk_ma_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="d_3">{{ trans('cruds.arsipIjazah.fields.d_3') }}</label>
                <div class="needsclick dropzone {{ $errors->has('d_3') ? 'is-invalid' : '' }}" id="d_3-dropzone">
                </div>
                @if($errors->has('d_3'))
                    <span class="text-danger">{{ $errors->first('d_3') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipIjazah.fields.d_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="s_1">{{ trans('cruds.arsipIjazah.fields.s_1') }}</label>
                <div class="needsclick dropzone {{ $errors->has('s_1') ? 'is-invalid' : '' }}" id="s_1-dropzone">
                </div>
                @if($errors->has('s_1'))
                    <span class="text-danger">{{ $errors->first('s_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipIjazah.fields.s_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="s_2">{{ trans('cruds.arsipIjazah.fields.s_2') }}</label>
                <div class="needsclick dropzone {{ $errors->has('s_2') ? 'is-invalid' : '' }}" id="s_2-dropzone">
                </div>
                @if($errors->has('s_2'))
                    <span class="text-danger">{{ $errors->first('s_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipIjazah.fields.s_2_helper') }}</span>
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
    Dropzone.options.sdDropzone = {
    url: '{{ route('admin.arsip-ijazahs.storeMedia') }}',
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
      $('form').find('input[name="sd"]').remove()
      $('form').append('<input type="hidden" name="sd" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="sd"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($arsipIjazah) && $arsipIjazah->sd)
      var file = {!! json_encode($arsipIjazah->sd) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="sd" value="' + file.file_name + '">')
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
    Dropzone.options.smpMtsDropzone = {
    url: '{{ route('admin.arsip-ijazahs.storeMedia') }}',
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
      $('form').find('input[name="smp_mts"]').remove()
      $('form').append('<input type="hidden" name="smp_mts" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="smp_mts"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($arsipIjazah) && $arsipIjazah->smp_mts)
      var file = {!! json_encode($arsipIjazah->smp_mts) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="smp_mts" value="' + file.file_name + '">')
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
    Dropzone.options.smaSmkMaDropzone = {
    url: '{{ route('admin.arsip-ijazahs.storeMedia') }}',
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
      $('form').find('input[name="sma_smk_ma"]').remove()
      $('form').append('<input type="hidden" name="sma_smk_ma" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="sma_smk_ma"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($arsipIjazah) && $arsipIjazah->sma_smk_ma)
      var file = {!! json_encode($arsipIjazah->sma_smk_ma) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="sma_smk_ma" value="' + file.file_name + '">')
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
    Dropzone.options.d3Dropzone = {
    url: '{{ route('admin.arsip-ijazahs.storeMedia') }}',
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
      $('form').find('input[name="d_3"]').remove()
      $('form').append('<input type="hidden" name="d_3" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="d_3"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($arsipIjazah) && $arsipIjazah->d_3)
      var file = {!! json_encode($arsipIjazah->d_3) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="d_3" value="' + file.file_name + '">')
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
    Dropzone.options.s1Dropzone = {
    url: '{{ route('admin.arsip-ijazahs.storeMedia') }}',
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
      $('form').find('input[name="s_1"]').remove()
      $('form').append('<input type="hidden" name="s_1" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="s_1"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($arsipIjazah) && $arsipIjazah->s_1)
      var file = {!! json_encode($arsipIjazah->s_1) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="s_1" value="' + file.file_name + '">')
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
    Dropzone.options.s2Dropzone = {
    url: '{{ route('admin.arsip-ijazahs.storeMedia') }}',
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
      $('form').find('input[name="s_2"]').remove()
      $('form').append('<input type="hidden" name="s_2" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="s_2"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($arsipIjazah) && $arsipIjazah->s_2)
      var file = {!! json_encode($arsipIjazah->s_2) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="s_2" value="' + file.file_name + '">')
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