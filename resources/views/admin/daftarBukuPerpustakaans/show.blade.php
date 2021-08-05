@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.daftarBukuPerpustakaan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.daftar-buku-perpustakaans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.daftarBukuPerpustakaan.fields.nama_buku') }}
                        </th>
                        <td>
                            {{ $daftarBukuPerpustakaan->nama_buku->nama_buku ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.daftarBukuPerpustakaan.fields.jumlah') }}
                        </th>
                        <td>
                            {{ $daftarBukuPerpustakaan->jumlah }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.daftarBukuPerpustakaan.fields.tempat_penyimpanan') }}
                        </th>
                        <td>
                            {{ $daftarBukuPerpustakaan->tempat_penyimpanan->nama_tempat_penyimpaanan ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.daftar-buku-perpustakaans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection