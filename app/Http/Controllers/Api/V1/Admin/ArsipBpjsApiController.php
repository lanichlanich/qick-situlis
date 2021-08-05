<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreArsipBpjRequest;
use App\Http\Requests\UpdateArsipBpjRequest;
use App\Http\Resources\Admin\ArsipBpjResource;
use App\Models\ArsipBpj;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArsipBpjsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('arsip_bpj_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ArsipBpjResource(ArsipBpj::with(['nama_ptk'])->get());
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

        return (new ArsipBpjResource($arsipBpj))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ArsipBpj $arsipBpj)
    {
        abort_if(Gate::denies('arsip_bpj_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ArsipBpjResource($arsipBpj->load(['nama_ptk']));
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

        return (new ArsipBpjResource($arsipBpj))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ArsipBpj $arsipBpj)
    {
        abort_if(Gate::denies('arsip_bpj_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arsipBpj->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
