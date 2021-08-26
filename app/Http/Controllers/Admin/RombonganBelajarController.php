<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyRombonganBelajarRequest;
use App\Http\Requests\StoreRombonganBelajarRequest;
use App\Http\Requests\UpdateRombonganBelajarRequest;
use App\Models\RombonganBelajar;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RombonganBelajarController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('rombongan_belajar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RombonganBelajar::query()->select(sprintf('%s.*', (new RombonganBelajar())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'rombongan_belajar_show';
                $editGate = 'rombongan_belajar_edit';
                $deleteGate = 'rombongan_belajar_delete';
                $crudRoutePart = 'rombongan-belajars';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('nama_rombel', function ($row) {
                return $row->nama_rombel ? $row->nama_rombel : '';
            });
            $table->editColumn('jurusan', function ($row) {
                return $row->jurusan ? RombonganBelajar::JURUSAN_RADIO[$row->jurusan] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.rombonganBelajars.index');
    }

    public function create()
    {
        abort_if(Gate::denies('rombongan_belajar_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rombonganBelajars.create');
    }

    public function store(StoreRombonganBelajarRequest $request)
    {
        $rombonganBelajar = RombonganBelajar::create($request->all());

        return redirect()->route('admin.rombongan-belajars.index');
    }

    public function edit(RombonganBelajar $rombonganBelajar)
    {
        abort_if(Gate::denies('rombongan_belajar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rombonganBelajars.edit', compact('rombonganBelajar'));
    }

    public function update(UpdateRombonganBelajarRequest $request, RombonganBelajar $rombonganBelajar)
    {
        $rombonganBelajar->update($request->all());

        return redirect()->route('admin.rombongan-belajars.index');
    }

    public function show(RombonganBelajar $rombonganBelajar)
    {
        abort_if(Gate::denies('rombongan_belajar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rombonganBelajars.show', compact('rombonganBelajar'));
    }

    public function destroy(RombonganBelajar $rombonganBelajar)
    {
        abort_if(Gate::denies('rombongan_belajar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rombonganBelajar->delete();

        return back();
    }

    public function massDestroy(MassDestroyRombonganBelajarRequest $request)
    {
        RombonganBelajar::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
