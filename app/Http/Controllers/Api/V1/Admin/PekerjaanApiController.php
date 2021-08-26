<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePekerjaanRequest;
use App\Http\Requests\UpdatePekerjaanRequest;
use App\Http\Resources\Admin\PekerjaanResource;
use App\Models\Pekerjaan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PekerjaanApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pekerjaan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PekerjaanResource(Pekerjaan::all());
    }

    public function store(StorePekerjaanRequest $request)
    {
        $pekerjaan = Pekerjaan::create($request->all());

        return (new PekerjaanResource($pekerjaan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Pekerjaan $pekerjaan)
    {
        abort_if(Gate::denies('pekerjaan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PekerjaanResource($pekerjaan);
    }

    public function update(UpdatePekerjaanRequest $request, Pekerjaan $pekerjaan)
    {
        $pekerjaan->update($request->all());

        return (new PekerjaanResource($pekerjaan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Pekerjaan $pekerjaan)
    {
        abort_if(Gate::denies('pekerjaan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pekerjaan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
