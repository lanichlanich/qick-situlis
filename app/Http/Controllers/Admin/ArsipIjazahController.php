<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyArsipIjazahRequest;
use App\Http\Requests\StoreArsipIjazahRequest;
use App\Http\Requests\UpdateArsipIjazahRequest;
use App\Models\ArsipIjazah;
use App\Models\Ptk;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ArsipIjazahController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('arsip_ijazah_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ArsipIjazah::with(['nama_ptk'])->select(sprintf('%s.*', (new ArsipIjazah())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'arsip_ijazah_show';
                $editGate = 'arsip_ijazah_edit';
                $deleteGate = 'arsip_ijazah_delete';
                $crudRoutePart = 'arsip-ijazahs';

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

            $table->editColumn('sd', function ($row) {
                return $row->sd ? '<a href="' . $row->sd->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('smp_mts', function ($row) {
                return $row->smp_mts ? '<a href="' . $row->smp_mts->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('sma_smk_ma', function ($row) {
                return $row->sma_smk_ma ? '<a href="' . $row->sma_smk_ma->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('d_3', function ($row) {
                return $row->d_3 ? '<a href="' . $row->d_3->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('s_1', function ($row) {
                return $row->s_1 ? '<a href="' . $row->s_1->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('s_2', function ($row) {
                return $row->s_2 ? '<a href="' . $row->s_2->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'nama_ptk', 'sd', 'smp_mts', 'sma_smk_ma', 'd_3', 's_1', 's_2']);

            return $table->make(true);
        }

        return view('admin.arsipIjazahs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('arsip_ijazah_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_ptks = Ptk::pluck('nama_lengkap', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.arsipIjazahs.create', compact('nama_ptks'));
    }

    public function store(StoreArsipIjazahRequest $request)
    {
        $arsipIjazah = ArsipIjazah::create($request->all());

        if ($request->input('sd', false)) {
            $arsipIjazah->addMedia(storage_path('tmp/uploads/' . basename($request->input('sd'))))->toMediaCollection('sd');
        }

        if ($request->input('smp_mts', false)) {
            $arsipIjazah->addMedia(storage_path('tmp/uploads/' . basename($request->input('smp_mts'))))->toMediaCollection('smp_mts');
        }

        if ($request->input('sma_smk_ma', false)) {
            $arsipIjazah->addMedia(storage_path('tmp/uploads/' . basename($request->input('sma_smk_ma'))))->toMediaCollection('sma_smk_ma');
        }

        if ($request->input('d_3', false)) {
            $arsipIjazah->addMedia(storage_path('tmp/uploads/' . basename($request->input('d_3'))))->toMediaCollection('d_3');
        }

        if ($request->input('s_1', false)) {
            $arsipIjazah->addMedia(storage_path('tmp/uploads/' . basename($request->input('s_1'))))->toMediaCollection('s_1');
        }

        if ($request->input('s_2', false)) {
            $arsipIjazah->addMedia(storage_path('tmp/uploads/' . basename($request->input('s_2'))))->toMediaCollection('s_2');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $arsipIjazah->id]);
        }

        return redirect()->route('admin.arsip-ijazahs.index');
    }

    public function edit(ArsipIjazah $arsipIjazah)
    {
        abort_if(Gate::denies('arsip_ijazah_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_ptks = Ptk::pluck('nama_lengkap', 'id')->prepend(trans('global.pleaseSelect'), '');

        $arsipIjazah->load('nama_ptk');

        return view('admin.arsipIjazahs.edit', compact('nama_ptks', 'arsipIjazah'));
    }

    public function update(UpdateArsipIjazahRequest $request, ArsipIjazah $arsipIjazah)
    {
        $arsipIjazah->update($request->all());

        if ($request->input('sd', false)) {
            if (!$arsipIjazah->sd || $request->input('sd') !== $arsipIjazah->sd->file_name) {
                if ($arsipIjazah->sd) {
                    $arsipIjazah->sd->delete();
                }
                $arsipIjazah->addMedia(storage_path('tmp/uploads/' . basename($request->input('sd'))))->toMediaCollection('sd');
            }
        } elseif ($arsipIjazah->sd) {
            $arsipIjazah->sd->delete();
        }

        if ($request->input('smp_mts', false)) {
            if (!$arsipIjazah->smp_mts || $request->input('smp_mts') !== $arsipIjazah->smp_mts->file_name) {
                if ($arsipIjazah->smp_mts) {
                    $arsipIjazah->smp_mts->delete();
                }
                $arsipIjazah->addMedia(storage_path('tmp/uploads/' . basename($request->input('smp_mts'))))->toMediaCollection('smp_mts');
            }
        } elseif ($arsipIjazah->smp_mts) {
            $arsipIjazah->smp_mts->delete();
        }

        if ($request->input('sma_smk_ma', false)) {
            if (!$arsipIjazah->sma_smk_ma || $request->input('sma_smk_ma') !== $arsipIjazah->sma_smk_ma->file_name) {
                if ($arsipIjazah->sma_smk_ma) {
                    $arsipIjazah->sma_smk_ma->delete();
                }
                $arsipIjazah->addMedia(storage_path('tmp/uploads/' . basename($request->input('sma_smk_ma'))))->toMediaCollection('sma_smk_ma');
            }
        } elseif ($arsipIjazah->sma_smk_ma) {
            $arsipIjazah->sma_smk_ma->delete();
        }

        if ($request->input('d_3', false)) {
            if (!$arsipIjazah->d_3 || $request->input('d_3') !== $arsipIjazah->d_3->file_name) {
                if ($arsipIjazah->d_3) {
                    $arsipIjazah->d_3->delete();
                }
                $arsipIjazah->addMedia(storage_path('tmp/uploads/' . basename($request->input('d_3'))))->toMediaCollection('d_3');
            }
        } elseif ($arsipIjazah->d_3) {
            $arsipIjazah->d_3->delete();
        }

        if ($request->input('s_1', false)) {
            if (!$arsipIjazah->s_1 || $request->input('s_1') !== $arsipIjazah->s_1->file_name) {
                if ($arsipIjazah->s_1) {
                    $arsipIjazah->s_1->delete();
                }
                $arsipIjazah->addMedia(storage_path('tmp/uploads/' . basename($request->input('s_1'))))->toMediaCollection('s_1');
            }
        } elseif ($arsipIjazah->s_1) {
            $arsipIjazah->s_1->delete();
        }

        if ($request->input('s_2', false)) {
            if (!$arsipIjazah->s_2 || $request->input('s_2') !== $arsipIjazah->s_2->file_name) {
                if ($arsipIjazah->s_2) {
                    $arsipIjazah->s_2->delete();
                }
                $arsipIjazah->addMedia(storage_path('tmp/uploads/' . basename($request->input('s_2'))))->toMediaCollection('s_2');
            }
        } elseif ($arsipIjazah->s_2) {
            $arsipIjazah->s_2->delete();
        }

        return redirect()->route('admin.arsip-ijazahs.index');
    }

    public function show(ArsipIjazah $arsipIjazah)
    {
        abort_if(Gate::denies('arsip_ijazah_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arsipIjazah->load('nama_ptk');

        return view('admin.arsipIjazahs.show', compact('arsipIjazah'));
    }

    public function destroy(ArsipIjazah $arsipIjazah)
    {
        abort_if(Gate::denies('arsip_ijazah_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arsipIjazah->delete();

        return back();
    }

    public function massDestroy(MassDestroyArsipIjazahRequest $request)
    {
        ArsipIjazah::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('arsip_ijazah_create') && Gate::denies('arsip_ijazah_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ArsipIjazah();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
