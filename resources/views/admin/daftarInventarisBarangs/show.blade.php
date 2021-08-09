@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.daftarInventarisBarang.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.daftar-inventaris-barangs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.daftarInventarisBarang.fields.nama_barang') }}
                        </th>
                        <td>
                            {{ $daftarInventarisBarang->nama_barang->nama_barang ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.daftarInventarisBarang.fields.jumlah') }}
                        </th>
                        <td>
                            {{ $daftarInventarisBarang->jumlah }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.daftarInventarisBarang.fields.daftar_ruangan') }}
                        </th>
                        <td>
                            {{ $daftarInventarisBarang->daftar_ruangan->nama_ruangan ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.daftarInventarisBarang.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\DaftarInventarisBarang::STATUS_RADIO[$daftarInventarisBarang->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.daftar-inventaris-barangs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection