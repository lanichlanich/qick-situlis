<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySkKepangkatanPnRequest;
use App\Http\Requests\StoreSkKepangkatanPnRequest;
use App\Http\Requests\UpdateSkKepangkatanPnRequest;
use App\Models\Ptk;
use App\Models\SkKepangkatanPn;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SkKepangkatanPnsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sk_kepangkatan_pn_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SkKepangkatanPn::with(['nama_ptk'])->select(sprintf('%s.*', (new SkKepangkatanPn())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'sk_kepangkatan_pn_show';
                $editGate = 'sk_kepangkatan_pn_edit';
                $deleteGate = 'sk_kepangkatan_pn_delete';
                $crudRoutePart = 'sk-kepangkatan-pns';

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
            $table->editColumn('pangkat_golongan', function ($row) {
                return $row->pangkat_golongan ? SkKepangkatanPn::PANGKAT_GOLONGAN_SELECT[$row->pangkat_golongan] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'nama_ptk', 'softfile']);

            return $table->make(true);
        }

        return view('admin.skKepangkatanPns.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sk_kepangkatan_pn_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_ptks = Ptk::pluck('nama_lengkap', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.skKepangkatanPns.create', compact('nama_ptks'));
    }

    public function store(StoreSkKepangkatanPnRequest $request)
    {
        $skKepangkatanPn = SkKepangkatanPn::create($request->all());

        if ($request->input('softfile', false)) {
            $skKepangkatanPn->addMedia(storage_path('tmp/uploads/' . basename($request->input('softfile'))))->toMediaCollection('softfile');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $skKepangkatanPn->id]);
        }

        return redirect()->route('admin.sk-kepangkatan-pns.index');
    }

    public function edit(SkKepangkatanPn $skKepangkatanPn)
    {
        abort_if(Gate::denies('sk_kepangkatan_pn_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_ptks = Ptk::pluck('nama_lengkap', 'id')->prepend(trans('global.pleaseSelect'), '');

        $skKepangkatanPn->load('nama_ptk');

        return view('admin.skKepangkatanPns.edit', compact('nama_ptks', 'skKepangkatanPn'));
    }

    public function update(UpdateSkKepangkatanPnRequest $request, SkKepangkatanPn $skKepangkatanPn)
    {
        $skKepangkatanPn->update($request->all());

        if ($request->input('softfile', false)) {
            if (!$skKepangkatanPn->softfile || $request->input('softfile') !== $skKepangkatanPn->softfile->file_name) {
                if ($skKepangkatanPn->softfile) {
                    $skKepangkatanPn->softfile->delete();
                }
                $skKepangkatanPn->addMedia(storage_path('tmp/uploads/' . basename($request->input('softfile'))))->toMediaCollection('softfile');
            }
        } elseif ($skKepangkatanPn->softfile) {
            $skKepangkatanPn->softfile->delete();
        }

        return redirect()->route('admin.sk-kepangkatan-pns.index');
    }

    public function show(SkKepangkatanPn $skKepangkatanPn)
    {
        abort_if(Gate::denies('sk_kepangkatan_pn_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skKepangkatanPn->load('nama_ptk');

        return view('admin.skKepangkatanPns.show', compact('skKepangkatanPn'));
    }

    public function destroy(SkKepangkatanPn $skKepangkatanPn)
    {
        abort_if(Gate::denies('sk_kepangkatan_pn_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skKepangkatanPn->delete();

        return back();
    }

    public function massDestroy(MassDestroySkKepangkatanPnRequest $request)
    {
        SkKepangkatanPn::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('sk_kepangkatan_pn_create') && Gate::denies('sk_kepangkatan_pn_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SkKepangkatanPn();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
