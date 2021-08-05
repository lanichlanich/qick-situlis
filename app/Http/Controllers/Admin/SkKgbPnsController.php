<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySkKgbPnRequest;
use App\Http\Requests\StoreSkKgbPnRequest;
use App\Http\Requests\UpdateSkKgbPnRequest;
use App\Models\Ptk;
use App\Models\SkKgbPn;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SkKgbPnsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sk_kgb_pn_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SkKgbPn::with(['nama_ptk'])->select(sprintf('%s.*', (new SkKgbPn())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'sk_kgb_pn_show';
                $editGate = 'sk_kgb_pn_edit';
                $deleteGate = 'sk_kgb_pn_delete';
                $crudRoutePart = 'sk-kgb-pns';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('no_surat', function ($row) {
                return $row->no_surat ? $row->no_surat : '';
            });

            $table->addColumn('nama_ptk_nama_lengkap', function ($row) {
                return $row->nama_ptk ? $row->nama_ptk->nama_lengkap : '';
            });

            $table->editColumn('masa_kerja_golongan', function ($row) {
                return $row->masa_kerja_golongan ? $row->masa_kerja_golongan : '';
            });
            $table->editColumn('masa_kerja_bulan', function ($row) {
                return $row->masa_kerja_bulan ? $row->masa_kerja_bulan : '';
            });
            $table->editColumn('softfile', function ($row) {
                return $row->softfile ? '<a href="' . $row->softfile->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'nama_ptk', 'softfile']);

            return $table->make(true);
        }

        return view('admin.skKgbPns.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sk_kgb_pn_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_ptks = Ptk::pluck('nama_lengkap', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.skKgbPns.create', compact('nama_ptks'));
    }

    public function store(StoreSkKgbPnRequest $request)
    {
        $skKgbPn = SkKgbPn::create($request->all());

        if ($request->input('softfile', false)) {
            $skKgbPn->addMedia(storage_path('tmp/uploads/' . basename($request->input('softfile'))))->toMediaCollection('softfile');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $skKgbPn->id]);
        }

        return redirect()->route('admin.sk-kgb-pns.index');
    }

    public function edit(SkKgbPn $skKgbPn)
    {
        abort_if(Gate::denies('sk_kgb_pn_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_ptks = Ptk::pluck('nama_lengkap', 'id')->prepend(trans('global.pleaseSelect'), '');

        $skKgbPn->load('nama_ptk');

        return view('admin.skKgbPns.edit', compact('nama_ptks', 'skKgbPn'));
    }

    public function update(UpdateSkKgbPnRequest $request, SkKgbPn $skKgbPn)
    {
        $skKgbPn->update($request->all());

        if ($request->input('softfile', false)) {
            if (!$skKgbPn->softfile || $request->input('softfile') !== $skKgbPn->softfile->file_name) {
                if ($skKgbPn->softfile) {
                    $skKgbPn->softfile->delete();
                }
                $skKgbPn->addMedia(storage_path('tmp/uploads/' . basename($request->input('softfile'))))->toMediaCollection('softfile');
            }
        } elseif ($skKgbPn->softfile) {
            $skKgbPn->softfile->delete();
        }

        return redirect()->route('admin.sk-kgb-pns.index');
    }

    public function show(SkKgbPn $skKgbPn)
    {
        abort_if(Gate::denies('sk_kgb_pn_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skKgbPn->load('nama_ptk');

        return view('admin.skKgbPns.show', compact('skKgbPn'));
    }

    public function destroy(SkKgbPn $skKgbPn)
    {
        abort_if(Gate::denies('sk_kgb_pn_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skKgbPn->delete();

        return back();
    }

    public function massDestroy(MassDestroySkKgbPnRequest $request)
    {
        SkKgbPn::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('sk_kgb_pn_create') && Gate::denies('sk_kgb_pn_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SkKgbPn();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
