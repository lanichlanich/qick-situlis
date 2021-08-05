<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreArsipNpwpRequest;
use App\Http\Requests\UpdateArsipNpwpRequest;
use App\Http\Resources\Admin\ArsipNpwpResource;
use App\Models\ArsipNpwp;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArsipNpwpApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('arsip_npwp_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ArsipNpwpResource(ArsipNpwp::with(['nama_ptk'])->get());
    }

    public function store(StoreArsipNpwpRequest $request)
    {
        $arsipNpwp = ArsipNpwp::create($request->all());

        if ($request->input('kartu_npwp', false)) {
            $arsipNpwp->addMedia(storage_path('tmp/uploads/' . basename($request->input('kartu_npwp'))))->toMediaCollection('kartu_npwp');
        }

        return (new ArsipNpwpResource($arsipNpwp))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ArsipNpwp $arsipNpwp)
    {
        abort_if(Gate::denies('arsip_npwp_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ArsipNpwpResource($arsipNpwp->load(['nama_ptk']));
    }

    public function update(UpdateArsipNpwpRequest $request, ArsipNpwp $arsipNpwp)
    {
        $arsipNpwp->update($request->all());

        if ($request->input('kartu_npwp', false)) {
            if (!$arsipNpwp->kartu_npwp || $request->input('kartu_npwp') !== $arsipNpwp->kartu_npwp->file_name) {
                if ($arsipNpwp->kartu_npwp) {
                    $arsipNpwp->kartu_npwp->delete();
                }
                $arsipNpwp->addMedia(storage_path('tmp/uploads/' . basename($request->input('kartu_npwp'))))->toMediaCollection('kartu_npwp');
            }
        } elseif ($arsipNpwp->kartu_npwp) {
            $arsipNpwp->kartu_npwp->delete();
        }

        return (new ArsipNpwpResource($arsipNpwp))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ArsipNpwp $arsipNpwp)
    {
        abort_if(Gate::denies('arsip_npwp_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arsipNpwp->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
