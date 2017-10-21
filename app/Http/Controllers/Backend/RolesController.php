<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Roles = Role::orderBy('name')->paginate(25);

        return view('backend.roles.index', compact('Roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Permissions = Permission::all();

        return view('backend.roles.create', compact('Permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request            $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $Role = new Role;
        $Role->name = $request->input('name');
        $Role->description = $request->input('description');
        $Role->save();

        $Role->permissions()->attach($request->permissions);

        Cache::forget('Permissions');

        return redirect()->route('admin.roles.index')->with('success', 'Regra cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int                         $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Role = Role::with('permissions')->where('id', $id)->first();
        $Permissions = Permission::all();

        return view('backend.roles.edit', compact('Role', 'Permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int                         $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Role = Role::with('permissions')->where('id', $id)->first();
        $Permissions = Permission::all();

        return view('backend.roles.edit', compact('Role', 'Permissions'));
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
        $Role = Role::where('id', $id)->first();
        $Role->update($request->except('_method', '_token', 'permissions'));
        $Role->permissions()->sync($request->input('permissions', []));

        Cache::forget('Permissions');

        return redirect()->route('admin.roles.index')->with('success', 'Regra atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int                                 $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Role::destroy($id);

        return redirect()->route('admin.roles.index')->with('success', 'Regra excluida com sucesso!');
    }
}
