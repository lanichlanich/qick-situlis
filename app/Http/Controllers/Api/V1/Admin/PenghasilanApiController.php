<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePenghasilanRequest;
use App\Http\Requests\UpdatePenghasilanRequest;
use App\Http\Resources\Admin\PenghasilanResource;
use App\Models\Penghasilan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PenghasilanApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('penghasilan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PenghasilanResource(Penghasilan::all());
    }

    public function store(StorePenghasilanRequest $request)
    {
        $penghasilan = Penghasilan::create($request->all());

        return (new PenghasilanResource($penghasilan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Penghasilan $penghasilan)
    {
        abort_if(Gate::denies('penghasilan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PenghasilanResource($penghasilan);
    }

    public function update(UpdatePenghasilanRequest $request, Penghasilan $penghasilan)
    {
        $penghasilan->update($request->all());

        return (new PenghasilanResource($penghasilan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Penghasilan $penghasilan)
    {
        abort_if(Gate::denies('penghasilan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penghasilan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
