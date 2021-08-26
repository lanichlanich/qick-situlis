<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTugasTambahanRequest;
use App\Http\Requests\UpdateTugasTambahanRequest;
use App\Http\Resources\Admin\TugasTambahanResource;
use App\Models\TugasTambahan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TugasTambahanApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tugas_tambahan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TugasTambahanResource(TugasTambahan::all());
    }

    public function store(StoreTugasTambahanRequest $request)
    {
        $tugasTambahan = TugasTambahan::create($request->all());

        return (new TugasTambahanResource($tugasTambahan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TugasTambahan $tugasTambahan)
    {
        abort_if(Gate::denies('tugas_tambahan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TugasTambahanResource($tugasTambahan);
    }

    public function update(UpdateTugasTambahanRequest $request, TugasTambahan $tugasTambahan)
    {
        $tugasTambahan->update($request->all());

        return (new TugasTambahanResource($tugasTambahan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TugasTambahan $tugasTambahan)
    {
        abort_if(Gate::denies('tugas_tambahan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tugasTambahan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
