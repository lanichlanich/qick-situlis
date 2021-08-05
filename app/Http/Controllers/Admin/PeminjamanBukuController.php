<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPeminjamanBukuRequest;
use App\Http\Requests\StorePeminjamanBukuRequest;
use App\Http\Requests\UpdatePeminjamanBukuRequest;
use App\Models\DaftarBuku;
use App\Models\PeminjamanBuku;
use App\Models\PeminjamBuku;
use App\Models\TempatPenyimpananBuku;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PeminjamanBukuController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('peminjaman_buku_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PeminjamanBuku::with(['peminjam_buku', 'nama_buku', 'tempat_penyimpanan_buku'])->select(sprintf('%s.*', (new PeminjamanBuku())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'peminjaman_buku_show';
                $editGate = 'peminjaman_buku_edit';
                $deleteGate = 'peminjaman_buku_delete';
                $crudRoutePart = 'peminjaman-bukus';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->addColumn('peminjam_buku_nama_peminjam', function ($row) {
                return $row->peminjam_buku ? $row->peminjam_buku->nama_peminjam : '';
            });

            $table->addColumn('nama_buku_nama_buku', function ($row) {
                return $row->nama_buku ? $row->nama_buku->nama_buku : '';
            });

            $table->addColumn('tempat_penyimpanan_buku_nama_tempat_penyimpaanan', function ($row) {
                return $row->tempat_penyimpanan_buku ? $row->tempat_penyimpanan_buku->nama_tempat_penyimpaanan : '';
            });

            $table->editColumn('jumlah_pinjam', function ($row) {
                return $row->jumlah_pinjam ? $row->jumlah_pinjam : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? PeminjamanBuku::STATUS_RADIO[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'peminjam_buku', 'nama_buku', 'tempat_penyimpanan_buku']);

            return $table->make(true);
        }

        return view('admin.peminjamanBukus.index');
    }

    public function create()
    {
        abort_if(Gate::denies('peminjaman_buku_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $peminjam_bukus = PeminjamBuku::pluck('nama_peminjam', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nama_bukus = DaftarBuku::pluck('nama_buku', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tempat_penyimpanan_bukus = TempatPenyimpananBuku::pluck('nama_tempat_penyimpaanan', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.peminjamanBukus.create', compact('peminjam_bukus', 'nama_bukus', 'tempat_penyimpanan_bukus'));
    }

    public function store(StorePeminjamanBukuRequest $request)
    {
        $peminjamanBuku = PeminjamanBuku::create($request->all());

        return redirect()->route('admin.peminjaman-bukus.index');
    }

    public function edit(PeminjamanBuku $peminjamanBuku)
    {
        abort_if(Gate::denies('peminjaman_buku_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $peminjam_bukus = PeminjamBuku::pluck('nama_peminjam', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nama_bukus = DaftarBuku::pluck('nama_buku', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tempat_penyimpanan_bukus = TempatPenyimpananBuku::pluck('nama_tempat_penyimpaanan', 'id')->prepend(trans('global.pleaseSelect'), '');

        $peminjamanBuku->load('peminjam_buku', 'nama_buku', 'tempat_penyimpanan_buku');

        return view('admin.peminjamanBukus.edit', compact('peminjam_bukus', 'nama_bukus', 'tempat_penyimpanan_bukus', 'peminjamanBuku'));
    }

    public function update(UpdatePeminjamanBukuRequest $request, PeminjamanBuku $peminjamanBuku)
    {
        $peminjamanBuku->update($request->all());

        return redirect()->route('admin.peminjaman-bukus.index');
    }

    public function show(PeminjamanBuku $peminjamanBuku)
    {
        abort_if(Gate::denies('peminjaman_buku_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $peminjamanBuku->load('peminjam_buku', 'nama_buku', 'tempat_penyimpanan_buku');

        return view('admin.peminjamanBukus.show', compact('peminjamanBuku'));
    }

    public function destroy(PeminjamanBuku $peminjamanBuku)
    {
        abort_if(Gate::denies('peminjaman_buku_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $peminjamanBuku->delete();

        return back();
    }

    public function massDestroy(MassDestroyPeminjamanBukuRequest $request)
    {
        PeminjamanBuku::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
