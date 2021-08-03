@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.suratMasuk.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.surat-masuks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.suratMasuk.fields.no_surat') }}
                        </th>
                        <td>
                            {{ $suratMasuk->no_surat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suratMasuk.fields.tgl_surat') }}
                        </th>
                        <td>
                            {{ $suratMasuk->tgl_surat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suratMasuk.fields.keterangan') }}
                        </th>
                        <td>
                            {{ $suratMasuk->keterangan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suratMasuk.fields.pengirim') }}
                        </th>
                        <td>
                            {{ $suratMasuk->pengirim }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suratMasuk.fields.softfile') }}
                        </th>
                        <td>
                            @if($suratMasuk->softfile)
                                <a href="{{ $suratMasuk->softfile->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.surat-masuks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection