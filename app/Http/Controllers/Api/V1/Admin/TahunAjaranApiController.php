<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTahunAjaranRequest;
use App\Http\Requests\UpdateTahunAjaranRequest;
use App\Http\Resources\Admin\TahunAjaranResource;
use App\Models\TahunAjaran;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TahunAjaranApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tahun_ajaran_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TahunAjaranResource(TahunAjaran::all());
    }

    public function store(StoreTahunAjaranRequest $request)
    {
        $tahunAjaran = TahunAjaran::create($request->all());

        return (new TahunAjaranResource($tahunAjaran))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TahunAjaran $tahunAjaran)
    {
        abort_if(Gate::denies('tahun_ajaran_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TahunAjaranResource($tahunAjaran);
    }

    public function update(UpdateTahunAjaranRequest $request, TahunAjaran $tahunAjaran)
    {
        $tahunAjaran->update($request->all());

        return (new TahunAjaranResource($tahunAjaran))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TahunAjaran $tahunAjaran)
    {
        abort_if(Gate::denies('tahun_ajaran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tahunAjaran->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
