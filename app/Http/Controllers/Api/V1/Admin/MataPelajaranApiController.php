<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMataPelajaranRequest;
use App\Http\Requests\UpdateMataPelajaranRequest;
use App\Http\Resources\Admin\MataPelajaranResource;
use App\Models\MataPelajaran;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MataPelajaranApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('mata_pelajaran_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MataPelajaranResource(MataPelajaran::all());
    }

    public function store(StoreMataPelajaranRequest $request)
    {
        $mataPelajaran = MataPelajaran::create($request->all());

        return (new MataPelajaranResource($mataPelajaran))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MataPelajaran $mataPelajaran)
    {
        abort_if(Gate::denies('mata_pelajaran_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MataPelajaranResource($mataPelajaran);
    }

    public function update(UpdateMataPelajaranRequest $request, MataPelajaran $mataPelajaran)
    {
        $mataPelajaran->update($request->all());

        return (new MataPelajaranResource($mataPelajaran))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MataPelajaran $mataPelajaran)
    {
        abort_if(Gate::denies('mata_pelajaran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mataPelajaran->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
