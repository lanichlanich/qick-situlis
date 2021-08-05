<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyArsipBpjRequest;
use App\Http\Requests\StoreArsipBpjRequest;
use App\Http\Requests\UpdateArsipBpjRequest;
use App\Models\ArsipBpj;
use App\Models\Ptk;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ArsipBpjsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('arsip_bpj_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ArsipBpj::with(['nama_ptk'])->select(sprintf('%s.*', (new ArsipBpj())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'arsip_bpj_show';
                $editGate = 'arsip_bpj_edit';
                $deleteGate = 'arsip_bpj_delete';
                $crudRoutePart = 'arsip-bpjs';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->addColumn('nama_ptk_nama_lengkap', function ($row) {
                return $row->nama_ptk ? $row->nama_ptk->nama_lengkap : '';
            });

            $table->editColumn('no_bpjs_pegawai', function ($row) {
                return $row->no_bpjs_pegawai ? $row->no_bpjs_pegawai : '';
            });
            $table->editColumn('kartu_bpjs_pegawai', function ($row) {
                return $row->kartu_bpjs_pegawai ? '<a href="' . $row->kartu_bpjs_pegawai->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('no_bpjs_suami_istri', function ($row) {
                return $row->no_bpjs_suami_istri ? $row->no_bpjs_suami_istri : '';
            });
            $table->editColumn('kartu_bpjs_suami_istri', function ($row) {
                return $row->kartu_bpjs_suami_istri ? '<a href="' . $row->kartu_bpjs_suami_istri->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('no_bpjs_anak_1', function ($row) {
                return $row->no_bpjs_anak_1 ? $row->no_bpjs_anak_1 : '';
            });
            $table->editColumn('kartu_anak_1', function ($row) {
                return $row->kartu_anak_1 ? '<a href="' . $row->kartu_anak_1->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('no_bpjs_anak_2', function ($row) {
                return $row->no_bpjs_anak_2 ? $row->no_bpjs_anak_2 : '';
            });
            $table->editColumn('kartu_anak_2', function ($row) {
                return $row->kartu_anak_2 ? '<a href="' . $row->kartu_anak_2->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('no_bpjs_anak_3', function ($row) {
                return $row->no_bpjs_anak_3 ? $row->no_bpjs_anak_3 : '';
            });
            $table->editColumn('kartu_anak_3', function ($row) {
                return $row->kartu_anak_3 ? '<a href="' . $row->kartu_anak_3->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'nama_ptk', 'kartu_bpjs_pegawai', 'kartu_bpjs_suami_istri', 'kartu_anak_1', 'kartu_anak_2', 'kartu_anak_3']);

            return $table->make(true);
        }

        return view('admin.arsipBpjs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('arsip_bpj_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_ptks = Ptk::pluck('nama_lengkap', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.arsipBpjs.create', compact('nama_ptks'));
    }

    public function store(StoreArsipBpjRequest $request)
    {
        $arsipBpj = ArsipBpj::create($request->all());

        if ($request->input('kartu_bpjs_pegawai', false)) {
            $arsipBpj->addMedia(storage_path('tmp/uploads/' . basename($request->input('kartu_bpjs_pegawai'))))->toMediaCollection('kartu_bpjs_pegawai');
        }

        if ($request->input('kartu_bpjs_suami_istri', false)) {
            $arsipBpj->addMedia(storage_path('tmp/uploads/' . basename($request->input('kartu_bpjs_suami_istri'))))->toMediaCollection('kartu_bpjs_suami_istri');
        }

        if ($request->input('kartu_anak_1', false)) {
            $arsipBpj->addMedia(storage_path('tmp/uploads/' . basename($request->input('kartu_anak_1'))))->toMediaCollection('kartu_anak_1');
        }

        if ($request->input('kartu_anak_2', false)) {
            $arsipBpj->addMedia(storage_path('tmp/uploads/' . basename($request->input('kartu_anak_2'))))->toMediaCollection('kartu_anak_2');
        }

        if ($request->input('kartu_anak_3', false)) {
            $arsipBpj->addMedia(storage_path('tmp/uploads/' . basename($request->input('kartu_anak_3'))))->toMediaCollection('kartu_anak_3');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $arsipBpj->id]);
        }

        return redirect()->route('admin.arsip-bpjs.index');
    }

    public function edit(ArsipBpj $arsipBpj)
    {
        abort_if(Gate::denies('arsip_bpj_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_ptks = Ptk::pluck('nama_lengkap', 'id')->prepend(trans('global.pleaseSelect'), '');

        $arsipBpj->load('nama_ptk');

        return view('admin.arsipBpjs.edit', compact('nama_ptks', 'arsipBpj'));
    }

    public function update(UpdateArsipBpjRequest $request, ArsipBpj $arsipBpj)
    {
        $arsipBpj->update($request->all());

        if ($request->input('kartu_bpjs_pegawai', false)) {
            if (!$arsipBpj->kartu_bpjs_pegawai || $request->input('kartu_bpjs_pegawai') !== $arsipBpj->kartu_bpjs_pegawai->file_name) {
                if ($arsipBpj->kartu_bpjs_pegawai) {
                    $arsipBpj->kartu_bpjs_pegawai->delete();
                }
                $arsipBpj->addMedia(storage_path('tmp/uploads/' . basename($request->input('kartu_bpjs_pegawai'))))->toMediaCollection('kartu_bpjs_pegawai');
            }
        } elseif ($arsipBpj->kartu_bpjs_pegawai) {
            $arsipBpj->kartu_bpjs_pegawai->delete();
        }

        if ($request->input('kartu_bpjs_suami_istri', false)) {
            if (!$arsipBpj->kartu_bpjs_suami_istri || $request->input('kartu_bpjs_suami_istri') !== $arsipBpj->kartu_bpjs_suami_istri->file_name) {
                if ($arsipBpj->kartu_bpjs_suami_istri) {
                    $arsipBpj->kartu_bpjs_suami_istri->delete();
                }
                $arsipBpj->addMedia(storage_path('tmp/uploads/' . basename($request->input('kartu_bpjs_suami_istri'))))->toMediaCollection('kartu_bpjs_suami_istri');
            }
        } elseif ($arsipBpj->kartu_bpjs_suami_istri) {
            $arsipBpj->kartu_bpjs_suami_istri->delete();
        }

        if ($request->input('kartu_anak_1', false)) {
            if (!$arsipBpj->kartu_anak_1 || $request->input('kartu_anak_1') !== $arsipBpj->kartu_anak_1->file_name) {
                if ($arsipBpj->kartu_anak_1) {
                    $arsipBpj->kartu_anak_1->delete();
                }
                $arsipBpj->addMedia(storage_path('tmp/uploads/' . basename($request->input('kartu_anak_1'))))->toMediaCollection('kartu_anak_1');
            }
        } elseif ($arsipBpj->kartu_anak_1) {
            $arsipBpj->kartu_anak_1->delete();
        }

        if ($request->input('kartu_anak_2', false)) {
            if (!$arsipBpj->kartu_anak_2 || $request->input('kartu_anak_2') !== $arsipBpj->kartu_anak_2->file_name) {
                if ($arsipBpj->kartu_anak_2) {
                    $arsipBpj->kartu_anak_2->delete();
                }
                $arsipBpj->addMedia(storage_path('tmp/uploads/' . basename($request->input('kartu_anak_2'))))->toMediaCollection('kartu_anak_2');
            }
        } elseif ($arsipBpj->kartu_anak_2) {
            $arsipBpj->kartu_anak_2->delete();
        }

        if ($request->input('kartu_anak_3', false)) {
            if (!$arsipBpj->kartu_anak_3 || $request->input('kartu_anak_3') !== $arsipBpj->kartu_anak_3->file_name) {
                if ($arsipBpj->kartu_anak_3) {
                    $arsipBpj->kartu_anak_3->delete();
                }
                $arsipBpj->addMedia(storage_path('tmp/uploads/' . basename($request->input('kartu_anak_3'))))->toMediaCollection('kartu_anak_3');
            }
        } elseif ($arsipBpj->kartu_anak_3) {
            $arsipBpj->kartu_anak_3->delete();
        }

        return redirect()->route('admin.arsip-bpjs.index');
    }

    public function show(ArsipBpj $arsipBpj)
    {
        abort_if(Gate::denies('arsip_bpj_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arsipBpj->load('nama_ptk');

        return view('admin.arsipBpjs.show', compact('arsipBpj'));
    }

    public function destroy(ArsipBpj $arsipBpj)
    {
        abort_if(Gate::denies('arsip_bpj_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arsipBpj->delete();

        return back();
    }

    public function massDestroy(MassDestroyArsipBpjRequest $request)
    {
        ArsipBpj::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('arsip_bpj_create') && Gate::denies('arsip_bpj_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ArsipBpj();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
