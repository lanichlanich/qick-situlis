@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.skPengangkatanHonorer.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sk-pengangkatan-honorers.update", [$skPengangkatanHonorer->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="no_surat">{{ trans('cruds.skPengangkatanHonorer.fields.no_surat') }}</label>
                <input class="form-control {{ $errors->has('no_surat') ? 'is-invalid' : '' }}" type="text" name="no_surat" id="no_surat" value="{{ old('no_surat', $skPengangkatanHonorer->no_surat) }}" required>
                @if($errors->has('no_surat'))
                    <span class="text-danger">{{ $errors->first('no_surat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.skPengangkatanHonorer.fields.no_surat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tgl_surat">{{ trans('cruds.skPengangkatanHonorer.fields.tgl_surat') }}</label>
                <input class="form-control date {{ $errors->has('tgl_surat') ? 'is-invalid' : '' }}" type="text" name="tgl_surat" id="tgl_surat" value="{{ old('tgl_surat', $skPengangkatanHonorer->tgl_surat) }}" required>
                @if($errors->has('tgl_surat'))
                    <span class="text-danger">{{ $errors->first('tgl_surat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.skPengangkatanHonorer.fields.tgl_surat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nama_ptk_id">{{ trans('cruds.skPengangkatanHonorer.fields.nama_ptk') }}</label>
                <select class="form-control select2 {{ $errors->has('nama_ptk') ? 'is-invalid' : '' }}" name="nama_ptk_id" id="nama_ptk_id" required>
                    @foreach($nama_ptks as $id => $entry)
                        <option value="{{ $id }}" {{ (old('nama_ptk_id') ? old('nama_ptk_id') : $skPengangkatanHonorer->nama_ptk->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('nama_ptk'))
                    <span class="text-danger">{{ $errors->first('nama_ptk') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.skPengangkatanHonorer.fields.nama_ptk_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tmt_sk">{{ trans('cruds.skPengangkatanHonorer.fields.tmt_sk') }}</label>
                <input class="form-control date {{ $errors->has('tmt_sk') ? 'is-invalid' : '' }}" type="text" name="tmt_sk" id="tmt_sk" value="{{ old('tmt_sk', $skPengangkatanHonorer->tmt_sk) }}" required>
                @if($errors->has('tmt_sk'))
                    <span class="text-danger">{{ $errors->first('tmt_sk') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.skPengangkatanHonorer.fields.tmt_sk_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="masa_kerja">{{ trans('cruds.skPengangkatanHonorer.fields.masa_kerja') }}</label>
                <input class="form-control {{ $errors->has('masa_kerja') ? 'is-invalid' : '' }}" type="number" name="masa_kerja" id="masa_kerja" value="{{ old('masa_kerja', $skPengangkatanHonorer->masa_kerja) }}" step="1" required>
                @if($errors->has('masa_kerja'))
                    <span class="text-danger">{{ $errors->first('masa_kerja') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.skPengangkatanHonorer.fields.masa_kerja_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="masa_kerja_bulan">{{ trans('cruds.skPengangkatanHonorer.fields.masa_kerja_bulan') }}</label>
                <input class="form-control {{ $errors->has('masa_kerja_bulan') ? 'is-invalid' : '' }}" type="number" name="masa_kerja_bulan" id="masa_kerja_bulan" value="{{ old('masa_kerja_bulan', $skPengangkatanHonorer->masa_kerja_bulan) }}" step="1" required>
                @if($errors->has('masa_kerja_bulan'))
                    <span class="text-danger">{{ $errors->first('masa_kerja_bulan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.skPengangkatanHonorer.fields.masa_kerja_bulan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="softfile">{{ trans('cruds.skPengangkatanHonorer.fields.softfile') }}</label>
                <div class="needsclick dropzone {{ $errors->has('softfile') ? 'is-invalid' : '' }}" id="softfile-dropzone">
                </div>
                @if($errors->has('softfile'))
                    <span class="text-danger">{{ $errors->first('softfile') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.skPengangkatanHonorer.fields.softfile_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.skPengangkatanHonorer.fields.jenis_ptk') }}</label>
                <select class="form-control {{ $errors->has('jenis_ptk') ? 'is-invalid' : '' }}" name="jenis_ptk" id="jenis_ptk" required>
                    <option value disabled {{ old('jenis_ptk', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\SkPengangkatanHonorer::JENIS_PTK_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('jenis_ptk', $skPengangkatanHonorer->jenis_ptk) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('jenis_ptk'))
                    <span class="text-danger">{{ $errors->first('jenis_ptk') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.skPengangkatanHonorer.fields.jenis_ptk_helper') }}</span>
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
    Dropzone.options.softfileDropzone = {
    url: '{{ route('admin.sk-pengangkatan-honorers.storeMedia') }}',
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
      $('form').find('input[name="softfile"]').remove()
      $('form').append('<input type="hidden" name="softfile" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="softfile"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($skPengangkatanHonorer) && $skPengangkatanHonorer->softfile)
      var file = {!! json_encode($skPengangkatanHonorer->softfile) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="softfile" value="' + file.file_name + '">')
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