<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDaftarBukuPerpustakaanRequest;
use App\Http\Requests\UpdateDaftarBukuPerpustakaanRequest;
use App\Http\Resources\Admin\DaftarBukuPerpustakaanResource;
use App\Models\DaftarBukuPerpustakaan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DaftarBukuPerpustakaanApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('daftar_buku_perpustakaan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DaftarBukuPerpustakaanResource(DaftarBukuPerpustakaan::with(['nama_buku', 'tempat_penyimpanan'])->get());
    }

    public function store(StoreDaftarBukuPerpustakaanRequest $request)
    {
        $daftarBukuPerpustakaan = DaftarBukuPerpustakaan::create($request->all());

        return (new DaftarBukuPerpustakaanResource($daftarBukuPerpustakaan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DaftarBukuPerpustakaan $daftarBukuPerpustakaan)
    {
        abort_if(Gate::denies('daftar_buku_perpustakaan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DaftarBukuPerpustakaanResource($daftarBukuPerpustakaan->load(['nama_buku', 'tempat_penyimpanan']));
    }

    public function update(UpdateDaftarBukuPerpustakaanRequest $request, DaftarBukuPerpustakaan $daftarBukuPerpustakaan)
    {
        $daftarBukuPerpustakaan->update($request->all());

        return (new DaftarBukuPerpustakaanResource($daftarBukuPerpustakaan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DaftarBukuPerpustakaan $daftarBukuPerpustakaan)
    {
        abort_if(Gate::denies('daftar_buku_perpustakaan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $daftarBukuPerpustakaan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
