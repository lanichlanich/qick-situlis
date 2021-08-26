<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyKelaRequest;
use App\Http\Requests\StoreKelaRequest;
use App\Http\Requests\UpdateKelaRequest;
use App\Models\Kela;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class KelasController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('kela_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Kela::query()->select(sprintf('%s.*', (new Kela())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'kela_show';
                $editGate = 'kela_edit';
                $deleteGate = 'kela_delete';
                $crudRoutePart = 'kelas';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('kelas', function ($row) {
                return $row->kelas ? $row->kelas : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.kelas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('kela_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kelas.create');
    }

    public function store(StoreKelaRequest $request)
    {
        $kela = Kela::create($request->all());

        return redirect()->route('admin.kelas.index');
    }

    public function edit(Kela $kela)
    {
        abort_if(Gate::denies('kela_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kelas.edit', compact('kela'));
    }

    public function update(UpdateKelaRequest $request, Kela $kela)
    {
        $kela->update($request->all());

        return redirect()->route('admin.kelas.index');
    }

    public function show(Kela $kela)
    {
        abort_if(Gate::denies('kela_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kelas.show', compact('kela'));
    }

    public function destroy(Kela $kela)
    {
        abort_if(Gate::denies('kela_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kela->delete();

        return back();
    }

    public function massDestroy(MassDestroyKelaRequest $request)
    {
        Kela::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
