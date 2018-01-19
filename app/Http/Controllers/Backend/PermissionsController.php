<?php

namespace App\Http\Controllers\Backend;

use Route;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Permissoes = Permission::orderBy('name')->where('visible')->paginate(50);

        return view('backend.permissions.index', compact('Permissoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request            $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $Permissao = new Permission;
        $Permissao->name = $request->input('name');
        $Permissao->label = $request->input('label');
        $Permissao->save();

        Cache::forget('Permissions');

        return redirect()->route('admin.permissions.index')->with('success', 'Permissão cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int                         $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Permissao = Permission::findOrFail($id);

        return view('backend.permissions.edit', compact('Permissao'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int                         $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Permissao = Permission::findOrFail($id);

        return view('backend.permissions.edit', compact('Permissao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request            $request
     * @param  int                                 $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $Permissao = Permission::findOrFail($id);
        $Permissao->update($request->except('_method', '_token'));

        Cache::forget('Permissions');

        return redirect()->route('admin.permissions.index')->with('success', 'Permissão atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int                                 $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Permission::destroy($id);

        return redirect()->route('admin.permissions.index')->with('success', 'Permissão excluida com sucesso!');
    }

    /**
     * Gera permissions baseadas na rotas.
     *
     * @return \Illuminate\Http\Response
     */
    public function getGerar()
    {
        $Rotas = Route::getRoutes();

        foreach ($Rotas as $Rota) {
            if (starts_with($Rota->getName(), 'admin')) {
                $filterRouter = ['admin.empresas*', 'admin.permissio*', 'admin.super*', 'admin.profile*'];

                if (! array_has($filterRouter, $Rota->getName())) {
                    Permission::firstorCreate(['name' => $Rota->getName()]);
                }
            }
        }

        Cache::forget('Permissions');

        return redirect()->back()->with('success', 'Lista de permissões gerada com sucesso!');
    }
}
