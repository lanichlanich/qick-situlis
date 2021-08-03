@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.skPengangkatanHonorer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sk-pengangkatan-honorers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.skPengangkatanHonorer.fields.no_surat') }}
                        </th>
                        <td>
                            {{ $skPengangkatanHonorer->no_surat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skPengangkatanHonorer.fields.tgl_surat') }}
                        </th>
                        <td>
                            {{ $skPengangkatanHonorer->tgl_surat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skPengangkatanHonorer.fields.nama_ptk') }}
                        </th>
                        <td>
                            {{ $skPengangkatanHonorer->nama_ptk->nama_lengkap ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skPengangkatanHonorer.fields.tmt_sk') }}
                        </th>
                        <td>
                            {{ $skPengangkatanHonorer->tmt_sk }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skPengangkatanHonorer.fields.masa_kerja') }}
                        </th>
                        <td>
                            {{ $skPengangkatanHonorer->masa_kerja }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skPengangkatanHonorer.fields.masa_kerja_bulan') }}
                        </th>
                        <td>
                            {{ $skPengangkatanHonorer->masa_kerja_bulan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skPengangkatanHonorer.fields.softfile') }}
                        </th>
                        <td>
                            @if($skPengangkatanHonorer->softfile)
                                <a href="{{ $skPengangkatanHonorer->softfile->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skPengangkatanHonorer.fields.jenis_ptk') }}
                        </th>
                        <td>
                            {{ App\Models\SkPengangkatanHonorer::JENIS_PTK_SELECT[$skPengangkatanHonorer->jenis_ptk] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sk-pengangkatan-honorers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection