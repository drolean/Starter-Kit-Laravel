<?php

namespace App\Http\Controllers\Backend;

use App\Models\Alert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlertsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Alertas = Alert::orderBy('id', 'DESC')->paginate(50);

        return view('backend.alertas.index', compact('Alertas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.alertas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Alert = new Alert;
        $Alert->title = $request->input('title');
        $Alert->description = $request->input('description');
        $Alert->start_at = $request->input('start_at');
        $Alert->end_at = $request->input('end_at');
        $Alert->save();

        return redirect()->route('admin.alertas.index')->with('success', 'Alerta cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Alert = Alert::findOrFail($id);

        return view('backend.alertas.edit', compact('Alert'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Alert = Alert::findOrFail($id);

        return view('backend.alertas.edit', compact('Alert'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Alert = Alert::findOrFail($id);
        $Alert->update($request->except('_method', '_token'));

        return redirect()->route('admin.alertas.index')->with('success', 'Alerta atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Alert::destroy($id);

        return redirect()->route('admin.alertas.index')->with('success', 'Alerta excluido com sucesso!');
    }
}
