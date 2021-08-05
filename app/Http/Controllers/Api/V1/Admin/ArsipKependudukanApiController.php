<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreArsipKependudukanRequest;
use App\Http\Requests\UpdateArsipKependudukanRequest;
use App\Http\Resources\Admin\ArsipKependudukanResource;
use App\Models\ArsipKependudukan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArsipKependudukanApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('arsip_kependudukan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ArsipKependudukanResource(ArsipKependudukan::with(['nama_ptk'])->get());
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

        return (new ArsipKependudukanResource($arsipKependudukan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ArsipKependudukan $arsipKependudukan)
    {
        abort_if(Gate::denies('arsip_kependudukan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ArsipKependudukanResource($arsipKependudukan->load(['nama_ptk']));
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

        return (new ArsipKependudukanResource($arsipKependudukan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ArsipKependudukan $arsipKependudukan)
    {
        abort_if(Gate::denies('arsip_kependudukan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arsipKependudukan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
