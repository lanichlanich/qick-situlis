<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDaftarSiswaRequest;
use App\Http\Requests\UpdateDaftarSiswaRequest;
use App\Http\Resources\Admin\DaftarSiswaResource;
use App\Models\DaftarSiswa;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DaftarSiswaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('daftar_siswa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DaftarSiswaResource(DaftarSiswa::with(['asal_sekolah'])->get());
    }

    public function store(StoreDaftarSiswaRequest $request)
    {
        $daftarSiswa = DaftarSiswa::create($request->all());

        return (new DaftarSiswaResource($daftarSiswa))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DaftarSiswa $daftarSiswa)
    {
        abort_if(Gate::denies('daftar_siswa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DaftarSiswaResource($daftarSiswa->load(['asal_sekolah']));
    }

    public function update(UpdateDaftarSiswaRequest $request, DaftarSiswa $daftarSiswa)
    {
        $daftarSiswa->update($request->all());

        return (new DaftarSiswaResource($daftarSiswa))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DaftarSiswa $daftarSiswa)
    {
        abort_if(Gate::denies('daftar_siswa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $daftarSiswa->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
