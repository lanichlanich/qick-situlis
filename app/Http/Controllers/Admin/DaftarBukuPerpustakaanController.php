<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDaftarBukuPerpustakaanRequest;
use App\Http\Requests\StoreDaftarBukuPerpustakaanRequest;
use App\Http\Requests\UpdateDaftarBukuPerpustakaanRequest;
use App\Models\DaftarBuku;
use App\Models\DaftarBukuPerpustakaan;
use App\Models\TempatPenyimpananBuku;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DaftarBukuPerpustakaanController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('daftar_buku_perpustakaan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DaftarBukuPerpustakaan::with(['nama_buku', 'tempat_penyimpanan'])->select(sprintf('%s.*', (new DaftarBukuPerpustakaan())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'daftar_buku_perpustakaan_show';
                $editGate = 'daftar_buku_perpustakaan_edit';
                $deleteGate = 'daftar_buku_perpustakaan_delete';
                $crudRoutePart = 'daftar-buku-perpustakaans';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->addColumn('nama_buku_nama_buku', function ($row) {
                return $row->nama_buku ? $row->nama_buku->nama_buku : '';
            });

            $table->editColumn('jumlah', function ($row) {
                return $row->jumlah ? $row->jumlah : '';
            });
            $table->addColumn('tempat_penyimpanan_nama_tempat_penyimpaanan', function ($row) {
                return $row->tempat_penyimpanan ? $row->tempat_penyimpanan->nama_tempat_penyimpaanan : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'nama_buku', 'tempat_penyimpanan']);

            return $table->make(true);
        }

        return view('admin.daftarBukuPerpustakaans.index');
    }

    public function create()
    {
        abort_if(Gate::denies('daftar_buku_perpustakaan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_bukus = DaftarBuku::pluck('nama_buku', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tempat_penyimpanans = TempatPenyimpananBuku::pluck('nama_tempat_penyimpaanan', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.daftarBukuPerpustakaans.create', compact('nama_bukus', 'tempat_penyimpanans'));
    }

    public function store(StoreDaftarBukuPerpustakaanRequest $request)
    {
        $daftarBukuPerpustakaan = DaftarBukuPerpustakaan::create($request->all());

        return redirect()->route('admin.daftar-buku-perpustakaans.index');
    }

    public function edit(DaftarBukuPerpustakaan $daftarBukuPerpustakaan)
    {
        abort_if(Gate::denies('daftar_buku_perpustakaan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_bukus = DaftarBuku::pluck('nama_buku', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tempat_penyimpanans = TempatPenyimpananBuku::pluck('nama_tempat_penyimpaanan', 'id')->prepend(trans('global.pleaseSelect'), '');

        $daftarBukuPerpustakaan->load('nama_buku', 'tempat_penyimpanan');

        return view('admin.daftarBukuPerpustakaans.edit', compact('nama_bukus', 'tempat_penyimpanans', 'daftarBukuPerpustakaan'));
    }

    public function update(UpdateDaftarBukuPerpustakaanRequest $request, DaftarBukuPerpustakaan $daftarBukuPerpustakaan)
    {
        $daftarBukuPerpustakaan->update($request->all());

        return redirect()->route('admin.daftar-buku-perpustakaans.index');
    }

    public function show(DaftarBukuPerpustakaan $daftarBukuPerpustakaan)
    {
        abort_if(Gate::denies('daftar_buku_perpustakaan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $daftarBukuPerpustakaan->load('nama_buku', 'tempat_penyimpanan');

        return view('admin.daftarBukuPerpustakaans.show', compact('daftarBukuPerpustakaan'));
    }

    public function destroy(DaftarBukuPerpustakaan $daftarBukuPerpustakaan)
    {
        abort_if(Gate::denies('daftar_buku_perpustakaan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $daftarBukuPerpustakaan->delete();

        return back();
    }

    public function massDestroy(MassDestroyDaftarBukuPerpustakaanRequest $request)
    {
        DaftarBukuPerpustakaan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
