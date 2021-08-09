<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDaftarInventarisBarangRequest;
use App\Http\Requests\StoreDaftarInventarisBarangRequest;
use App\Http\Requests\UpdateDaftarInventarisBarangRequest;
use App\Models\DaftarInventarisBarang;
use App\Models\DaftarNamaBarang;
use App\Models\DaftarRuangan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DaftarInventarisBarangController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('daftar_inventaris_barang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DaftarInventarisBarang::with(['nama_barang', 'daftar_ruangan'])->select(sprintf('%s.*', (new DaftarInventarisBarang())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'daftar_inventaris_barang_show';
                $editGate = 'daftar_inventaris_barang_edit';
                $deleteGate = 'daftar_inventaris_barang_delete';
                $crudRoutePart = 'daftar-inventaris-barangs';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->addColumn('nama_barang_nama_barang', function ($row) {
                return $row->nama_barang ? $row->nama_barang->nama_barang : '';
            });

            $table->editColumn('jumlah', function ($row) {
                return $row->jumlah ? $row->jumlah : '';
            });
            $table->addColumn('daftar_ruangan_nama_ruangan', function ($row) {
                return $row->daftar_ruangan ? $row->daftar_ruangan->nama_ruangan : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? DaftarInventarisBarang::STATUS_RADIO[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'nama_barang', 'daftar_ruangan']);

            return $table->make(true);
        }

        return view('admin.daftarInventarisBarangs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('daftar_inventaris_barang_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_barangs = DaftarNamaBarang::pluck('nama_barang', 'id')->prepend(trans('global.pleaseSelect'), '');

        $daftar_ruangans = DaftarRuangan::pluck('nama_ruangan', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.daftarInventarisBarangs.create', compact('nama_barangs', 'daftar_ruangans'));
    }

    public function store(StoreDaftarInventarisBarangRequest $request)
    {
        $daftarInventarisBarang = DaftarInventarisBarang::create($request->all());

        return redirect()->route('admin.daftar-inventaris-barangs.index');
    }

    public function edit(DaftarInventarisBarang $daftarInventarisBarang)
    {
        abort_if(Gate::denies('daftar_inventaris_barang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_barangs = DaftarNamaBarang::pluck('nama_barang', 'id')->prepend(trans('global.pleaseSelect'), '');

        $daftar_ruangans = DaftarRuangan::pluck('nama_ruangan', 'id')->prepend(trans('global.pleaseSelect'), '');

        $daftarInventarisBarang->load('nama_barang', 'daftar_ruangan');

        return view('admin.daftarInventarisBarangs.edit', compact('nama_barangs', 'daftar_ruangans', 'daftarInventarisBarang'));
    }

    public function update(UpdateDaftarInventarisBarangRequest $request, DaftarInventarisBarang $daftarInventarisBarang)
    {
        $daftarInventarisBarang->update($request->all());

        return redirect()->route('admin.daftar-inventaris-barangs.index');
    }

    public function show(DaftarInventarisBarang $daftarInventarisBarang)
    {
        abort_if(Gate::denies('daftar_inventaris_barang_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $daftarInventarisBarang->load('nama_barang', 'daftar_ruangan');

        return view('admin.daftarInventarisBarangs.show', compact('daftarInventarisBarang'));
    }

    public function destroy(DaftarInventarisBarang $daftarInventarisBarang)
    {
        abort_if(Gate::denies('daftar_inventaris_barang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $daftarInventarisBarang->delete();

        return back();
    }

    public function massDestroy(MassDestroyDaftarInventarisBarangRequest $request)
    {
        DaftarInventarisBarang::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
