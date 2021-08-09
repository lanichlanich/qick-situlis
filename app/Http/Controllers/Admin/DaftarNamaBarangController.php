<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDaftarNamaBarangRequest;
use App\Http\Requests\StoreDaftarNamaBarangRequest;
use App\Http\Requests\UpdateDaftarNamaBarangRequest;
use App\Models\DaftarNamaBarang;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DaftarNamaBarangController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('daftar_nama_barang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DaftarNamaBarang::query()->select(sprintf('%s.*', (new DaftarNamaBarang())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'daftar_nama_barang_show';
                $editGate = 'daftar_nama_barang_edit';
                $deleteGate = 'daftar_nama_barang_delete';
                $crudRoutePart = 'daftar-nama-barangs';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('nama_barang', function ($row) {
                return $row->nama_barang ? $row->nama_barang : '';
            });
            $table->editColumn('keterangan', function ($row) {
                return $row->keterangan ? $row->keterangan : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.daftarNamaBarangs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('daftar_nama_barang_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.daftarNamaBarangs.create');
    }

    public function store(StoreDaftarNamaBarangRequest $request)
    {
        $daftarNamaBarang = DaftarNamaBarang::create($request->all());

        return redirect()->route('admin.daftar-nama-barangs.index');
    }

    public function edit(DaftarNamaBarang $daftarNamaBarang)
    {
        abort_if(Gate::denies('daftar_nama_barang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.daftarNamaBarangs.edit', compact('daftarNamaBarang'));
    }

    public function update(UpdateDaftarNamaBarangRequest $request, DaftarNamaBarang $daftarNamaBarang)
    {
        $daftarNamaBarang->update($request->all());

        return redirect()->route('admin.daftar-nama-barangs.index');
    }

    public function show(DaftarNamaBarang $daftarNamaBarang)
    {
        abort_if(Gate::denies('daftar_nama_barang_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.daftarNamaBarangs.show', compact('daftarNamaBarang'));
    }

    public function destroy(DaftarNamaBarang $daftarNamaBarang)
    {
        abort_if(Gate::denies('daftar_nama_barang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $daftarNamaBarang->delete();

        return back();
    }

    public function massDestroy(MassDestroyDaftarNamaBarangRequest $request)
    {
        DaftarNamaBarang::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
