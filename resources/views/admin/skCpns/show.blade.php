@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.skCpn.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sk-cpns.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.skCpn.fields.no_surat') }}
                        </th>
                        <td>
                            {{ $skCpn->no_surat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skCpn.fields.tgl_surat') }}
                        </th>
                        <td>
                            {{ $skCpn->tgl_surat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skCpn.fields.nama_ptk') }}
                        </th>
                        <td>
                            {{ $skCpn->nama_ptk->nama_lengkap ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skCpn.fields.tmt_cpns') }}
                        </th>
                        <td>
                            {{ $skCpn->tmt_cpns }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skCpn.fields.masa_kerja_golongan') }}
                        </th>
                        <td>
                            {{ $skCpn->masa_kerja_golongan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skCpn.fields.masa_kerja_bulan') }}
                        </th>
                        <td>
                            {{ $skCpn->masa_kerja_bulan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skCpn.fields.softfile') }}
                        </th>
                        <td>
                            @if($skCpn->softfile)
                                <a href="{{ $skCpn->softfile->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skCpn.fields.pangkat_golongan') }}
                        </th>
                        <td>
                            {{ App\Models\SkCpn::PANGKAT_GOLONGAN_SELECT[$skCpn->pangkat_golongan] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sk-cpns.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection