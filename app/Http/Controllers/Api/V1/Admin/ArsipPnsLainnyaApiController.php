<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreArsipPnsLainnyaRequest;
use App\Http\Requests\UpdateArsipPnsLainnyaRequest;
use App\Http\Resources\Admin\ArsipPnsLainnyaResource;
use App\Models\ArsipPnsLainnya;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArsipPnsLainnyaApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('arsip_pns_lainnya_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ArsipPnsLainnyaResource(ArsipPnsLainnya::with(['nama_ptk'])->get());
    }

    public function store(StoreArsipPnsLainnyaRequest $request)
    {
        $arsipPnsLainnya = ArsipPnsLainnya::create($request->all());

        if ($request->input('karpeg', false)) {
            $arsipPnsLainnya->addMedia(storage_path('tmp/uploads/' . basename($request->input('karpeg'))))->toMediaCollection('karpeg');
        }

        if ($request->input('karis_karsu', false)) {
            $arsipPnsLainnya->addMedia(storage_path('tmp/uploads/' . basename($request->input('karis_karsu'))))->toMediaCollection('karis_karsu');
        }

        if ($request->input('taspen', false)) {
            $arsipPnsLainnya->addMedia(storage_path('tmp/uploads/' . basename($request->input('taspen'))))->toMediaCollection('taspen');
        }

        return (new ArsipPnsLainnyaResource($arsipPnsLainnya))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ArsipPnsLainnya $arsipPnsLainnya)
    {
        abort_if(Gate::denies('arsip_pns_lainnya_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ArsipPnsLainnyaResource($arsipPnsLainnya->load(['nama_ptk']));
    }

    public function update(UpdateArsipPnsLainnyaRequest $request, ArsipPnsLainnya $arsipPnsLainnya)
    {
        $arsipPnsLainnya->update($request->all());

        if ($request->input('karpeg', false)) {
            if (!$arsipPnsLainnya->karpeg || $request->input('karpeg') !== $arsipPnsLainnya->karpeg->file_name) {
                if ($arsipPnsLainnya->karpeg) {
                    $arsipPnsLainnya->karpeg->delete();
                }
                $arsipPnsLainnya->addMedia(storage_path('tmp/uploads/' . basename($request->input('karpeg'))))->toMediaCollection('karpeg');
            }
        } elseif ($arsipPnsLainnya->karpeg) {
            $arsipPnsLainnya->karpeg->delete();
        }

        if ($request->input('karis_karsu', false)) {
            if (!$arsipPnsLainnya->karis_karsu || $request->input('karis_karsu') !== $arsipPnsLainnya->karis_karsu->file_name) {
                if ($arsipPnsLainnya->karis_karsu) {
                    $arsipPnsLainnya->karis_karsu->delete();
                }
                $arsipPnsLainnya->addMedia(storage_path('tmp/uploads/' . basename($request->input('karis_karsu'))))->toMediaCollection('karis_karsu');
            }
        } elseif ($arsipPnsLainnya->karis_karsu) {
            $arsipPnsLainnya->karis_karsu->delete();
        }

        if ($request->input('taspen', false)) {
            if (!$arsipPnsLainnya->taspen || $request->input('taspen') !== $arsipPnsLainnya->taspen->file_name) {
                if ($arsipPnsLainnya->taspen) {
                    $arsipPnsLainnya->taspen->delete();
                }
                $arsipPnsLainnya->addMedia(storage_path('tmp/uploads/' . basename($request->input('taspen'))))->toMediaCollection('taspen');
            }
        } elseif ($arsipPnsLainnya->taspen) {
            $arsipPnsLainnya->taspen->delete();
        }

        return (new ArsipPnsLainnyaResource($arsipPnsLainnya))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ArsipPnsLainnya $arsipPnsLainnya)
    {
        abort_if(Gate::denies('arsip_pns_lainnya_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arsipPnsLainnya->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
