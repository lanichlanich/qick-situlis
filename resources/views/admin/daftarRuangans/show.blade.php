@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.daftarRuangan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.daftar-ruangans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.daftarRuangan.fields.nama_ruangan') }}
                        </th>
                        <td>
                            {{ $daftarRuangan->nama_ruangan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.daftarRuangan.fields.kondisi_ruangan') }}
                        </th>
                        <td>
                            {{ App\Models\DaftarRuangan::KONDISI_RUANGAN_RADIO[$daftarRuangan->kondisi_ruangan] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.daftar-ruangans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection