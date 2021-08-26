<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePendidikanTerakhirRequest;
use App\Http\Requests\UpdatePendidikanTerakhirRequest;
use App\Http\Resources\Admin\PendidikanTerakhirResource;
use App\Models\PendidikanTerakhir;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PendidikanTerakhirApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pendidikan_terakhir_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PendidikanTerakhirResource(PendidikanTerakhir::all());
    }

    public function store(StorePendidikanTerakhirRequest $request)
    {
        $pendidikanTerakhir = PendidikanTerakhir::create($request->all());

        return (new PendidikanTerakhirResource($pendidikanTerakhir))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PendidikanTerakhir $pendidikanTerakhir)
    {
        abort_if(Gate::denies('pendidikan_terakhir_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PendidikanTerakhirResource($pendidikanTerakhir);
    }

    public function update(UpdatePendidikanTerakhirRequest $request, PendidikanTerakhir $pendidikanTerakhir)
    {
        $pendidikanTerakhir->update($request->all());

        return (new PendidikanTerakhirResource($pendidikanTerakhir))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PendidikanTerakhir $pendidikanTerakhir)
    {
        abort_if(Gate::denies('pendidikan_terakhir_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pendidikanTerakhir->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
