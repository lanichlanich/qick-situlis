<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDaftarRuanganRequest;
use App\Http\Requests\UpdateDaftarRuanganRequest;
use App\Http\Resources\Admin\DaftarRuanganResource;
use App\Models\DaftarRuangan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DaftarRuanganApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('daftar_ruangan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DaftarRuanganResource(DaftarRuangan::all());
    }

    public function store(StoreDaftarRuanganRequest $request)
    {
        $daftarRuangan = DaftarRuangan::create($request->all());

        return (new DaftarRuanganResource($daftarRuangan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DaftarRuangan $daftarRuangan)
    {
        abort_if(Gate::denies('daftar_ruangan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DaftarRuanganResource($daftarRuangan);
    }

    public function update(UpdateDaftarRuanganRequest $request, DaftarRuangan $daftarRuangan)
    {
        $daftarRuangan->update($request->all());

        return (new DaftarRuanganResource($daftarRuangan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DaftarRuangan $daftarRuangan)
    {
        abort_if(Gate::denies('daftar_ruangan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $daftarRuangan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
