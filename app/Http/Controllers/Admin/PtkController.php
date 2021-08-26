<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPtkRequest;
use App\Http\Requests\StorePtkRequest;
use App\Http\Requests\UpdatePtkRequest;
use App\Models\Ptk;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PtkController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('ptk_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Ptk::query()->select(sprintf('%s.*', (new Ptk())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'ptk_show';
                $editGate = 'ptk_edit';
                $deleteGate = 'ptk_delete';
                $crudRoutePart = 'ptks';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('nama_lengkap', function ($row) {
                return $row->nama_lengkap ? $row->nama_lengkap : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.ptks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('ptk_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ptks.create');
    }

    public function store(StorePtkRequest $request)
    {
        $ptk = Ptk::create($request->all());

        return redirect()->route('admin.ptks.index');
    }

    public function edit(Ptk $ptk)
    {
        abort_if(Gate::denies('ptk_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ptks.edit', compact('ptk'));
    }

    public function update(UpdatePtkRequest $request, Ptk $ptk)
    {
        $ptk->update($request->all());

        return redirect()->route('admin.ptks.index');
    }

    public function show(Ptk $ptk)
    {
        abort_if(Gate::denies('ptk_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ptks.show', compact('ptk'));
    }

    public function destroy(Ptk $ptk)
    {
        abort_if(Gate::denies('ptk_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ptk->delete();

        return back();
    }

    public function massDestroy(MassDestroyPtkRequest $request)
    {
        Ptk::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
