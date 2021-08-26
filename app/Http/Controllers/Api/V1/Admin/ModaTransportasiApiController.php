<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreModaTransportasiRequest;
use App\Http\Requests\UpdateModaTransportasiRequest;
use App\Http\Resources\Admin\ModaTransportasiResource;
use App\Models\ModaTransportasi;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ModaTransportasiApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('moda_transportasi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ModaTransportasiResource(ModaTransportasi::all());
    }

    public function store(StoreModaTransportasiRequest $request)
    {
        $modaTransportasi = ModaTransportasi::create($request->all());

        return (new ModaTransportasiResource($modaTransportasi))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ModaTransportasi $modaTransportasi)
    {
        abort_if(Gate::denies('moda_transportasi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ModaTransportasiResource($modaTransportasi);
    }

    public function update(UpdateModaTransportasiRequest $request, ModaTransportasi $modaTransportasi)
    {
        $modaTransportasi->update($request->all());

        return (new ModaTransportasiResource($modaTransportasi))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ModaTransportasi $modaTransportasi)
    {
        abort_if(Gate::denies('moda_transportasi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modaTransportasi->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
