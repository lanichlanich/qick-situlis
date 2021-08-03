@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.skKepangkatanPn.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sk-kepangkatan-pns.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.skKepangkatanPn.fields.no_surat') }}
                        </th>
                        <td>
                            {{ $skKepangkatanPn->no_surat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skKepangkatanPn.fields.tgl_surat') }}
                        </th>
                        <td>
                            {{ $skKepangkatanPn->tgl_surat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skKepangkatanPn.fields.nama_ptk') }}
                        </th>
                        <td>
                            {{ $skKepangkatanPn->nama_ptk->nama_lengkap ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skKepangkatanPn.fields.tmt_cpns') }}
                        </th>
                        <td>
                            {{ $skKepangkatanPn->tmt_cpns }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skKepangkatanPn.fields.masa_kerja_golongan') }}
                        </th>
                        <td>
                            {{ $skKepangkatanPn->masa_kerja_golongan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skKepangkatanPn.fields.masa_kerja_bulan') }}
                        </th>
                        <td>
                            {{ $skKepangkatanPn->masa_kerja_bulan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skKepangkatanPn.fields.softfile') }}
                        </th>
                        <td>
                            @if($skKepangkatanPn->softfile)
                                <a href="{{ $skKepangkatanPn->softfile->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skKepangkatanPn.fields.pangkat_golongan') }}
                        </th>
                        <td>
                            {{ App\Models\SkKepangkatanPn::PANGKAT_GOLONGAN_SELECT[$skKepangkatanPn->pangkat_golongan] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sk-kepangkatan-pns.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection