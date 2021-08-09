<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDaftarInventarisBarangRequest;
use App\Http\Requests\UpdateDaftarInventarisBarangRequest;
use App\Http\Resources\Admin\DaftarInventarisBarangResource;
use App\Models\DaftarInventarisBarang;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DaftarInventarisBarangApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('daftar_inventaris_barang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DaftarInventarisBarangResource(DaftarInventarisBarang::with(['nama_barang', 'daftar_ruangan'])->get());
    }

    public function store(StoreDaftarInventarisBarangRequest $request)
    {
        $daftarInventarisBarang = DaftarInventarisBarang::create($request->all());

        return (new DaftarInventarisBarangResource($daftarInventarisBarang))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DaftarInventarisBarang $daftarInventarisBarang)
    {
        abort_if(Gate::denies('daftar_inventaris_barang_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DaftarInventarisBarangResource($daftarInventarisBarang->load(['nama_barang', 'daftar_ruangan']));
    }

    public function update(UpdateDaftarInventarisBarangRequest $request, DaftarInventarisBarang $daftarInventarisBarang)
    {
        $daftarInventarisBarang->update($request->all());

        return (new DaftarInventarisBarangResource($daftarInventarisBarang))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DaftarInventarisBarang $daftarInventarisBarang)
    {
        abort_if(Gate::denies('daftar_inventaris_barang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $daftarInventarisBarang->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
