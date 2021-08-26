<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTahunRequest;
use App\Http\Requests\UpdateTahunRequest;
use App\Http\Resources\Admin\TahunResource;
use App\Models\Tahun;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TahunApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tahun_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TahunResource(Tahun::all());
    }

    public function store(StoreTahunRequest $request)
    {
        $tahun = Tahun::create($request->all());

        return (new TahunResource($tahun))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Tahun $tahun)
    {
        abort_if(Gate::denies('tahun_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TahunResource($tahun);
    }

    public function update(UpdateTahunRequest $request, Tahun $tahun)
    {
        $tahun->update($request->all());

        return (new TahunResource($tahun))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Tahun $tahun)
    {
        abort_if(Gate::denies('tahun_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tahun->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
