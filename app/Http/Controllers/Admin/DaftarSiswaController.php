<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDaftarSiswaRequest;
use App\Http\Requests\StoreDaftarSiswaRequest;
use App\Http\Requests\UpdateDaftarSiswaRequest;
use App\Models\DaftarSiswa;
use App\Models\SmpMt;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DaftarSiswaController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('daftar_siswa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DaftarSiswa::with(['asal_sekolah'])->select(sprintf('%s.*', (new DaftarSiswa())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'daftar_siswa_show';
                $editGate = 'daftar_siswa_edit';
                $deleteGate = 'daftar_siswa_delete';
                $crudRoutePart = 'daftar-siswas';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('no_induk', function ($row) {
                return $row->no_induk ? $row->no_induk : '';
            });
            $table->editColumn('nama_siswa', function ($row) {
                return $row->nama_siswa ? $row->nama_siswa : '';
            });
            $table->editColumn('nisn', function ($row) {
                return $row->nisn ? $row->nisn : '';
            });

            $table->addColumn('asal_sekolah_smp_mts', function ($row) {
                return $row->asal_sekolah ? $row->asal_sekolah->smp_mts : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? DaftarSiswa::STATUS_RADIO[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'asal_sekolah']);

            return $table->make(true);
        }

        return view('admin.daftarSiswas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('daftar_siswa_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asal_sekolahs = SmpMt::pluck('smp_mts', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.daftarSiswas.create', compact('asal_sekolahs'));
    }

    public function store(StoreDaftarSiswaRequest $request)
    {
        $daftarSiswa = DaftarSiswa::create($request->all());

        return redirect()->route('admin.daftar-siswas.index');
    }

    public function edit(DaftarSiswa $daftarSiswa)
    {
        abort_if(Gate::denies('daftar_siswa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asal_sekolahs = SmpMt::pluck('smp_mts', 'id')->prepend(trans('global.pleaseSelect'), '');

        $daftarSiswa->load('asal_sekolah');

        return view('admin.daftarSiswas.edit', compact('asal_sekolahs', 'daftarSiswa'));
    }

    public function update(UpdateDaftarSiswaRequest $request, DaftarSiswa $daftarSiswa)
    {
        $daftarSiswa->update($request->all());

        return redirect()->route('admin.daftar-siswas.index');
    }

    public function show(DaftarSiswa $daftarSiswa)
    {
        abort_if(Gate::denies('daftar_siswa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $daftarSiswa->load('asal_sekolah');

        return view('admin.daftarSiswas.show', compact('daftarSiswa'));
    }

    public function destroy(DaftarSiswa $daftarSiswa)
    {
        abort_if(Gate::denies('daftar_siswa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $daftarSiswa->delete();

        return back();
    }

    public function massDestroy(MassDestroyDaftarSiswaRequest $request)
    {
        DaftarSiswa::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
