@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.suratKeluar.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.surat-keluars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.suratKeluar.fields.no_surat') }}
                        </th>
                        <td>
                            {{ $suratKeluar->no_surat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suratKeluar.fields.tgl_surat') }}
                        </th>
                        <td>
                            {{ $suratKeluar->tgl_surat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suratKeluar.fields.keterangan') }}
                        </th>
                        <td>
                            {{ $suratKeluar->keterangan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suratKeluar.fields.tujuan') }}
                        </th>
                        <td>
                            {{ $suratKeluar->tujuan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suratKeluar.fields.softfile') }}
                        </th>
                        <td>
                            @if($suratKeluar->softfile)
                                <a href="{{ $suratKeluar->softfile->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.surat-keluars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection