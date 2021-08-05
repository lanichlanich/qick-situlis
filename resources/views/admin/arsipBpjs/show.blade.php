@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.arsipBpj.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.arsip-bpjs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipBpj.fields.nama_ptk') }}
                        </th>
                        <td>
                            {{ $arsipBpj->nama_ptk->nama_lengkap ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipBpj.fields.no_bpjs_pegawai') }}
                        </th>
                        <td>
                            {{ $arsipBpj->no_bpjs_pegawai }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipBpj.fields.kartu_bpjs_pegawai') }}
                        </th>
                        <td>
                            @if($arsipBpj->kartu_bpjs_pegawai)
                                <a href="{{ $arsipBpj->kartu_bpjs_pegawai->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipBpj.fields.no_bpjs_suami_istri') }}
                        </th>
                        <td>
                            {{ $arsipBpj->no_bpjs_suami_istri }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipBpj.fields.kartu_bpjs_suami_istri') }}
                        </th>
                        <td>
                            @if($arsipBpj->kartu_bpjs_suami_istri)
                                <a href="{{ $arsipBpj->kartu_bpjs_suami_istri->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipBpj.fields.no_bpjs_anak_1') }}
                        </th>
                        <td>
                            {{ $arsipBpj->no_bpjs_anak_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipBpj.fields.kartu_anak_1') }}
                        </th>
                        <td>
                            @if($arsipBpj->kartu_anak_1)
                                <a href="{{ $arsipBpj->kartu_anak_1->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipBpj.fields.no_bpjs_anak_2') }}
                        </th>
                        <td>
                            {{ $arsipBpj->no_bpjs_anak_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipBpj.fields.kartu_anak_2') }}
                        </th>
                        <td>
                            @if($arsipBpj->kartu_anak_2)
                                <a href="{{ $arsipBpj->kartu_anak_2->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipBpj.fields.no_bpjs_anak_3') }}
                        </th>
                        <td>
                            {{ $arsipBpj->no_bpjs_anak_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipBpj.fields.kartu_anak_3') }}
                        </th>
                        <td>
                            @if($arsipBpj->kartu_anak_3)
                                <a href="{{ $arsipBpj->kartu_anak_3->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.arsip-bpjs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection