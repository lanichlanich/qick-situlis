@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.peminjamanBuku.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.peminjaman-bukus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.peminjamanBuku.fields.peminjam_buku') }}
                        </th>
                        <td>
                            {{ $peminjamanBuku->peminjam_buku->nama_peminjam ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.peminjamanBuku.fields.nama_buku') }}
                        </th>
                        <td>
                            {{ $peminjamanBuku->nama_buku->nama_buku ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.peminjamanBuku.fields.tempat_penyimpanan_buku') }}
                        </th>
                        <td>
                            {{ $peminjamanBuku->tempat_penyimpanan_buku->nama_tempat_penyimpaanan ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.peminjamanBuku.fields.jumlah_pinjam') }}
                        </th>
                        <td>
                            {{ $peminjamanBuku->jumlah_pinjam }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.peminjamanBuku.fields.tanggal_pinjam') }}
                        </th>
                        <td>
                            {{ $peminjamanBuku->tanggal_pinjam }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.peminjamanBuku.fields.tanggal_pengembalian') }}
                        </th>
                        <td>
                            {{ $peminjamanBuku->tanggal_pengembalian }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.peminjamanBuku.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\PeminjamanBuku::STATUS_RADIO[$peminjamanBuku->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.peminjaman-bukus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection