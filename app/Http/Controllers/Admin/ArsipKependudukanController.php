<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyArsipKependudukanRequest;
use App\Http\Requests\StoreArsipKependudukanRequest;
use App\Http\Requests\UpdateArsipKependudukanRequest;
use App\Models\ArsipKependudukan;
use App\Models\Ptk;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ArsipKependudukanController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('arsip_kependudukan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ArsipKependudukan::with(['nama_ptk'])->select(sprintf('%s.*', (new ArsipKependudukan())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'arsip_kependudukan_show';
                $editGate = 'arsip_kependudukan_edit';
                $deleteGate = 'arsip_kependudukan_delete';
                $crudRoutePart = 'arsip-kependudukans';

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

            $table->editColumn('no_nik', function ($row) {
                return $row->no_nik ? $row->no_nik : '';
            });
            $table->editColumn('ktp', function ($row) {
                return $row->ktp ? '<a href="' . $row->ktp->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('no_kk', function ($row) {
                return $row->no_kk ? $row->no_kk : '';
            });
            $table->editColumn('kartu_keluarga', function ($row) {
                return $row->kartu_keluarga ? '<a href="' . $row->kartu_keluarga->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('akta_lahir', function ($row) {
                return $row->akta_lahir ? '<a href="' . $row->akta_lahir->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'nama_ptk', 'ktp', 'kartu_keluarga', 'akta_lahir']);

            return $table->make(true);
        }

        return view('admin.arsipKependudukans.index');
    }

    public function create()
    {
        abort_if(Gate::denies('arsip_kependudukan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_ptks = Ptk::pluck('nama_lengkap', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.arsipKependudukans.create', compact('nama_ptks'));
    }

    public function store(StoreArsipKependudukanRequest $request)
    {
        $arsipKependudukan = ArsipKependudukan::create($request->all());

        if ($request->input('ktp', false)) {
            $arsipKependudukan->addMedia(storage_path('tmp/uploads/' . basename($request->input('ktp'))))->toMediaCollection('ktp');
        }

        if ($request->input('kartu_keluarga', false)) {
            $arsipKependudukan->addMedia(storage_path('tmp/uploads/' . basename($request->input('kartu_keluarga'))))->toMediaCollection('kartu_keluarga');
        }

        if ($request->input('akta_lahir', false)) {
            $arsipKependudukan->addMedia(storage_path('tmp/uploads/' . basename($request->input('akta_lahir'))))->toMediaCollection('akta_lahir');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $arsipKependudukan->id]);
        }

        return redirect()->route('admin.arsip-kependudukans.index');
    }

    public function edit(ArsipKependudukan $arsipKependudukan)
    {
        abort_if(Gate::denies('arsip_kependudukan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_ptks = Ptk::pluck('nama_lengkap', 'id')->prepend(trans('global.pleaseSelect'), '');

        $arsipKependudukan->load('nama_ptk');

        return view('admin.arsipKependudukans.edit', compact('nama_ptks', 'arsipKependudukan'));
    }

    public function update(UpdateArsipKependudukanRequest $request, ArsipKependudukan $arsipKependudukan)
    {
        $arsipKependudukan->update($request->all());

        if ($request->input('ktp', false)) {
            if (!$arsipKependudukan->ktp || $request->input('ktp') !== $arsipKependudukan->ktp->file_name) {
                if ($arsipKependudukan->ktp) {
                    $arsipKependudukan->ktp->delete();
                }
                $arsipKependudukan->addMedia(storage_path('tmp/uploads/' . basename($request->input('ktp'))))->toMediaCollection('ktp');
            }
        } elseif ($arsipKependudukan->ktp) {
            $arsipKependudukan->ktp->delete();
        }

        if ($request->input('kartu_keluarga', false)) {
            if (!$arsipKependudukan->kartu_keluarga || $request->input('kartu_keluarga') !== $arsipKependudukan->kartu_keluarga->file_name) {
                if ($arsipKependudukan->kartu_keluarga) {
                    $arsipKependudukan->kartu_keluarga->delete();
                }
                $arsipKependudukan->addMedia(storage_path('tmp/uploads/' . basename($request->input('kartu_keluarga'))))->toMediaCollection('kartu_keluarga');
            }
        } elseif ($arsipKependudukan->kartu_keluarga) {
            $arsipKependudukan->kartu_keluarga->delete();
        }

        if ($request->input('akta_lahir', false)) {
            if (!$arsipKependudukan->akta_lahir || $request->input('akta_lahir') !== $arsipKependudukan->akta_lahir->file_name) {
                if ($arsipKependudukan->akta_lahir) {
                    $arsipKependudukan->akta_lahir->delete();
                }
                $arsipKependudukan->addMedia(storage_path('tmp/uploads/' . basename($request->input('akta_lahir'))))->toMediaCollection('akta_lahir');
            }
        } elseif ($arsipKependudukan->akta_lahir) {
            $arsipKependudukan->akta_lahir->delete();
        }

        return redirect()->route('admin.arsip-kependudukans.index');
    }

    public function show(ArsipKependudukan $arsipKependudukan)
    {
        abort_if(Gate::denies('arsip_kependudukan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arsipKependudukan->load('nama_ptk');

        return view('admin.arsipKependudukans.show', compact('arsipKependudukan'));
    }

    public function destroy(ArsipKependudukan $arsipKependudukan)
    {
        abort_if(Gate::denies('arsip_kependudukan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arsipKependudukan->delete();

        return back();
    }

    public function massDestroy(MassDestroyArsipKependudukanRequest $request)
    {
        ArsipKependudukan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('arsip_kependudukan_create') && Gate::denies('arsip_kependudukan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ArsipKependudukan();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
