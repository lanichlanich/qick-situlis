<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreArsipIjazahRequest;
use App\Http\Requests\UpdateArsipIjazahRequest;
use App\Http\Resources\Admin\ArsipIjazahResource;
use App\Models\ArsipIjazah;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArsipIjazahApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('arsip_ijazah_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ArsipIjazahResource(ArsipIjazah::with(['nama_ptk'])->get());
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

        return (new ArsipIjazahResource($arsipIjazah))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ArsipIjazah $arsipIjazah)
    {
        abort_if(Gate::denies('arsip_ijazah_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ArsipIjazahResource($arsipIjazah->load(['nama_ptk']));
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

        return (new ArsipIjazahResource($arsipIjazah))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ArsipIjazah $arsipIjazah)
    {
        abort_if(Gate::denies('arsip_ijazah_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arsipIjazah->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
