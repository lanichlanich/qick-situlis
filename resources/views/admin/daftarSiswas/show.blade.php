@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.daftarSiswa.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.daftar-siswas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.daftarSiswa.fields.no_induk') }}
                        </th>
                        <td>
                            {{ $daftarSiswa->no_induk }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.daftarSiswa.fields.nama_siswa') }}
                        </th>
                        <td>
                            {{ $daftarSiswa->nama_siswa }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.daftarSiswa.fields.nisn') }}
                        </th>
                        <td>
                            {{ $daftarSiswa->nisn }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.daftarSiswa.fields.tgl_masuk') }}
                        </th>
                        <td>
                            {{ $daftarSiswa->tgl_masuk }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.daftarSiswa.fields.asal_sekolah') }}
                        </th>
                        <td>
                            {{ $daftarSiswa->asal_sekolah->smp_mts ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.daftarSiswa.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\DaftarSiswa::STATUS_RADIO[$daftarSiswa->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.daftarSiswa.fields.tgl_keluar') }}
                        </th>
                        <td>
                            {{ $daftarSiswa->tgl_keluar }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.daftar-siswas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection