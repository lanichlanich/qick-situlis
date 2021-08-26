<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySmpMtRequest;
use App\Http\Requests\StoreSmpMtRequest;
use App\Http\Requests\UpdateSmpMtRequest;
use App\Models\SmpMt;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SmpMtsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('smp_mt_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SmpMt::query()->select(sprintf('%s.*', (new SmpMt())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'smp_mt_show';
                $editGate = 'smp_mt_edit';
                $deleteGate = 'smp_mt_delete';
                $crudRoutePart = 'smp-mts';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('smp_mts', function ($row) {
                return $row->smp_mts ? $row->smp_mts : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.smpMts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('smp_mt_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.smpMts.create');
    }

    public function store(StoreSmpMtRequest $request)
    {
        $smpMt = SmpMt::create($request->all());

        return redirect()->route('admin.smp-mts.index');
    }

    public function edit(SmpMt $smpMt)
    {
        abort_if(Gate::denies('smp_mt_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.smpMts.edit', compact('smpMt'));
    }

    public function update(UpdateSmpMtRequest $request, SmpMt $smpMt)
    {
        $smpMt->update($request->all());

        return redirect()->route('admin.smp-mts.index');
    }

    public function show(SmpMt $smpMt)
    {
        abort_if(Gate::denies('smp_mt_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.smpMts.show', compact('smpMt'));
    }

    public function destroy(SmpMt $smpMt)
    {
        abort_if(Gate::denies('smp_mt_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $smpMt->delete();

        return back();
    }

    public function massDestroy(MassDestroySmpMtRequest $request)
    {
        SmpMt::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
