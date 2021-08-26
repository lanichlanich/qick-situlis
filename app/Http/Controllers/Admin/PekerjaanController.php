<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPekerjaanRequest;
use App\Http\Requests\StorePekerjaanRequest;
use App\Http\Requests\UpdatePekerjaanRequest;
use App\Models\Pekerjaan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PekerjaanController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('pekerjaan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Pekerjaan::query()->select(sprintf('%s.*', (new Pekerjaan())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'pekerjaan_show';
                $editGate = 'pekerjaan_edit';
                $deleteGate = 'pekerjaan_delete';
                $crudRoutePart = 'pekerjaans';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('pekerjaan', function ($row) {
                return $row->pekerjaan ? $row->pekerjaan : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.pekerjaans.index');
    }

    public function create()
    {
        abort_if(Gate::denies('pekerjaan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pekerjaans.create');
    }

    public function store(StorePekerjaanRequest $request)
    {
        $pekerjaan = Pekerjaan::create($request->all());

        return redirect()->route('admin.pekerjaans.index');
    }

    public function edit(Pekerjaan $pekerjaan)
    {
        abort_if(Gate::denies('pekerjaan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pekerjaans.edit', compact('pekerjaan'));
    }

    public function update(UpdatePekerjaanRequest $request, Pekerjaan $pekerjaan)
    {
        $pekerjaan->update($request->all());

        return redirect()->route('admin.pekerjaans.index');
    }

    public function show(Pekerjaan $pekerjaan)
    {
        abort_if(Gate::denies('pekerjaan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pekerjaans.show', compact('pekerjaan'));
    }

    public function destroy(Pekerjaan $pekerjaan)
    {
        abort_if(Gate::denies('pekerjaan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pekerjaan->delete();

        return back();
    }

    public function massDestroy(MassDestroyPekerjaanRequest $request)
    {
        Pekerjaan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
