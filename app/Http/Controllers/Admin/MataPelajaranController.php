<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMataPelajaranRequest;
use App\Http\Requests\StoreMataPelajaranRequest;
use App\Http\Requests\UpdateMataPelajaranRequest;
use App\Models\MataPelajaran;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MataPelajaranController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('mata_pelajaran_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MataPelajaran::query()->select(sprintf('%s.*', (new MataPelajaran())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'mata_pelajaran_show';
                $editGate = 'mata_pelajaran_edit';
                $deleteGate = 'mata_pelajaran_delete';
                $crudRoutePart = 'mata-pelajarans';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('mata_pelajararan', function ($row) {
                return $row->mata_pelajararan ? $row->mata_pelajararan : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.mataPelajarans.index');
    }

    public function create()
    {
        abort_if(Gate::denies('mata_pelajaran_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mataPelajarans.create');
    }

    public function store(StoreMataPelajaranRequest $request)
    {
        $mataPelajaran = MataPelajaran::create($request->all());

        return redirect()->route('admin.mata-pelajarans.index');
    }

    public function edit(MataPelajaran $mataPelajaran)
    {
        abort_if(Gate::denies('mata_pelajaran_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mataPelajarans.edit', compact('mataPelajaran'));
    }

    public function update(UpdateMataPelajaranRequest $request, MataPelajaran $mataPelajaran)
    {
        $mataPelajaran->update($request->all());

        return redirect()->route('admin.mata-pelajarans.index');
    }

    public function show(MataPelajaran $mataPelajaran)
    {
        abort_if(Gate::denies('mata_pelajaran_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mataPelajarans.show', compact('mataPelajaran'));
    }

    public function destroy(MataPelajaran $mataPelajaran)
    {
        abort_if(Gate::denies('mata_pelajaran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mataPelajaran->delete();

        return back();
    }

    public function massDestroy(MassDestroyMataPelajaranRequest $request)
    {
        MataPelajaran::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
