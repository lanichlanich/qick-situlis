<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDaftarNamaBarangRequest;
use App\Http\Requests\UpdateDaftarNamaBarangRequest;
use App\Http\Resources\Admin\DaftarNamaBarangResource;
use App\Models\DaftarNamaBarang;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DaftarNamaBarangApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('daftar_nama_barang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DaftarNamaBarangResource(DaftarNamaBarang::all());
    }

    public function store(StoreDaftarNamaBarangRequest $request)
    {
        $daftarNamaBarang = DaftarNamaBarang::create($request->all());

        return (new DaftarNamaBarangResource($daftarNamaBarang))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DaftarNamaBarang $daftarNamaBarang)
    {
        abort_if(Gate::denies('daftar_nama_barang_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DaftarNamaBarangResource($daftarNamaBarang);
    }

    public function update(UpdateDaftarNamaBarangRequest $request, DaftarNamaBarang $daftarNamaBarang)
    {
        $daftarNamaBarang->update($request->all());

        return (new DaftarNamaBarangResource($daftarNamaBarang))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DaftarNamaBarang $daftarNamaBarang)
    {
        abort_if(Gate::denies('daftar_nama_barang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $daftarNamaBarang->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
