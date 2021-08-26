<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTugasTambahanRequest;
use App\Http\Requests\StoreTugasTambahanRequest;
use App\Http\Requests\UpdateTugasTambahanRequest;
use App\Models\TugasTambahan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TugasTambahanController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('tugas_tambahan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TugasTambahan::query()->select(sprintf('%s.*', (new TugasTambahan())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'tugas_tambahan_show';
                $editGate = 'tugas_tambahan_edit';
                $deleteGate = 'tugas_tambahan_delete';
                $crudRoutePart = 'tugas-tambahans';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('tugas_tambahan', function ($row) {
                return $row->tugas_tambahan ? $row->tugas_tambahan : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.tugasTambahans.index');
    }

    public function create()
    {
        abort_if(Gate::denies('tugas_tambahan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tugasTambahans.create');
    }

    public function store(StoreTugasTambahanRequest $request)
    {
        $tugasTambahan = TugasTambahan::create($request->all());

        return redirect()->route('admin.tugas-tambahans.index');
    }

    public function edit(TugasTambahan $tugasTambahan)
    {
        abort_if(Gate::denies('tugas_tambahan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tugasTambahans.edit', compact('tugasTambahan'));
    }

    public function update(UpdateTugasTambahanRequest $request, TugasTambahan $tugasTambahan)
    {
        $tugasTambahan->update($request->all());

        return redirect()->route('admin.tugas-tambahans.index');
    }

    public function show(TugasTambahan $tugasTambahan)
    {
        abort_if(Gate::denies('tugas_tambahan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tugasTambahans.show', compact('tugasTambahan'));
    }

    public function destroy(TugasTambahan $tugasTambahan)
    {
        abort_if(Gate::denies('tugas_tambahan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tugasTambahan->delete();

        return back();
    }

    public function massDestroy(MassDestroyTugasTambahanRequest $request)
    {
        TugasTambahan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
