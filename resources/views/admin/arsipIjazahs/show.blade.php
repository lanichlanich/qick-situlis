@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.arsipIjazah.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.arsip-ijazahs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipIjazah.fields.nama_ptk') }}
                        </th>
                        <td>
                            {{ $arsipIjazah->nama_ptk->nama_lengkap ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipIjazah.fields.sd') }}
                        </th>
                        <td>
                            @if($arsipIjazah->sd)
                                <a href="{{ $arsipIjazah->sd->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipIjazah.fields.smp_mts') }}
                        </th>
                        <td>
                            @if($arsipIjazah->smp_mts)
                                <a href="{{ $arsipIjazah->smp_mts->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipIjazah.fields.sma_smk_ma') }}
                        </th>
                        <td>
                            @if($arsipIjazah->sma_smk_ma)
                                <a href="{{ $arsipIjazah->sma_smk_ma->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipIjazah.fields.d_3') }}
                        </th>
                        <td>
                            @if($arsipIjazah->d_3)
                                <a href="{{ $arsipIjazah->d_3->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipIjazah.fields.s_1') }}
                        </th>
                        <td>
                            @if($arsipIjazah->s_1)
                                <a href="{{ $arsipIjazah->s_1->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipIjazah.fields.s_2') }}
                        </th>
                        <td>
                            @if($arsipIjazah->s_2)
                                <a href="{{ $arsipIjazah->s_2->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.arsip-ijazahs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection