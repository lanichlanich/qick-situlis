@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.skKgbPn.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sk-kgb-pns.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.skKgbPn.fields.no_surat') }}
                        </th>
                        <td>
                            {{ $skKgbPn->no_surat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skKgbPn.fields.tgl_surat') }}
                        </th>
                        <td>
                            {{ $skKgbPn->tgl_surat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skKgbPn.fields.nama_ptk') }}
                        </th>
                        <td>
                            {{ $skKgbPn->nama_ptk->nama_lengkap ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skKgbPn.fields.tmt_kgb') }}
                        </th>
                        <td>
                            {{ $skKgbPn->tmt_kgb }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skKgbPn.fields.masa_kerja_golongan') }}
                        </th>
                        <td>
                            {{ $skKgbPn->masa_kerja_golongan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skKgbPn.fields.masa_kerja_bulan') }}
                        </th>
                        <td>
                            {{ $skKgbPn->masa_kerja_bulan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skKgbPn.fields.softfile') }}
                        </th>
                        <td>
                            @if($skKgbPn->softfile)
                                <a href="{{ $skKgbPn->softfile->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sk-kgb-pns.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection