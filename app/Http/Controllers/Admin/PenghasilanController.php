<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPenghasilanRequest;
use App\Http\Requests\StorePenghasilanRequest;
use App\Http\Requests\UpdatePenghasilanRequest;
use App\Models\Penghasilan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PenghasilanController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('penghasilan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Penghasilan::query()->select(sprintf('%s.*', (new Penghasilan())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'penghasilan_show';
                $editGate = 'penghasilan_edit';
                $deleteGate = 'penghasilan_delete';
                $crudRoutePart = 'penghasilans';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('penghasilan', function ($row) {
                return $row->penghasilan ? $row->penghasilan : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.penghasilans.index');
    }

    public function create()
    {
        abort_if(Gate::denies('penghasilan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.penghasilans.create');
    }

    public function store(StorePenghasilanRequest $request)
    {
        $penghasilan = Penghasilan::create($request->all());

        return redirect()->route('admin.penghasilans.index');
    }

    public function edit(Penghasilan $penghasilan)
    {
        abort_if(Gate::denies('penghasilan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.penghasilans.edit', compact('penghasilan'));
    }

    public function update(UpdatePenghasilanRequest $request, Penghasilan $penghasilan)
    {
        $penghasilan->update($request->all());

        return redirect()->route('admin.penghasilans.index');
    }

    public function show(Penghasilan $penghasilan)
    {
        abort_if(Gate::denies('penghasilan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.penghasilans.show', compact('penghasilan'));
    }

    public function destroy(Penghasilan $penghasilan)
    {
        abort_if(Gate::denies('penghasilan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penghasilan->delete();

        return back();
    }

    public function massDestroy(MassDestroyPenghasilanRequest $request)
    {
        Penghasilan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
