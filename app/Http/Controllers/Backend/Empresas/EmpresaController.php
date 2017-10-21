<?php

namespace App\Http\Controllers\Backend\Empresas;

use App\User;
use App\Models\Companie;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminEmpresaPostRequest;
use App\Notifications\CompanieNewNotification;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Empresas = Companie::orderBy('empresa')->with('user')->get();

        return view('backend.empresas.index', compact('Empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.empresas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminEmpresaPostRequest $request)
    {
        $token = hash_hmac('sha256', str_random(60), config('app.key'));

        // Cria nova empresa
        $Companie = new Companie;
        $Companie->empresa = $request->input('empresa');
        $Companie->cnpj = $request->input('cnpj');
        $Companie->telefone = $request->input('telefone');
        $Companie->endereco = $request->input('endereco');
        $Companie->active = true;
        $Companie->save();

        // Cria novo usuario
        $Usuario = new User;
        $Usuario->name = $request->input('name');
        $Usuario->email = $request->input('email');
        $Usuario->password = $request->input('password');
        $Usuario->activation_code = $token;
        $Usuario->is_admin = true;
        $Usuario->save();

        // Altera o vinculo do usuario a empresa
        $Usuario->company_id = $Companie->id;
        $Usuario->save();

        // Altera o vinculo da empresa ao usuario
        $Companie->user_id = $Usuario->id;
        $Companie->save();

        // Vincula o usuario a empresa
        $Usuario->Empresas()->sync([$Usuario->Companie->id]);

        // Manda Email de ativação de usuario
        $Usuario->sendUserConfirmationNotification($token);

        // Manda email de nova empresa no sistema para o usuario
        $Usuario->notify(new CompanieNewNotification($Companie));

        // Manda email para o super do sistema
        User::getSuper()->each(function ($item) use ($Companie) {
            $item->notify(new CompanieNewNotification($Companie));
        });

        return redirect()->route('admin.empresas.index')->with('success', 'Empresa criada com sucesso!');
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
        $Companie = Companie::with('UsersMany')->findOrFail($id);

        return view('backend.empresas.edit', compact('Companie'));
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
        $Companie = Companie::with('UsersMany')->findOrFail($id);

        return view('backend.empresas.edit', compact('Companie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminEmpresaPostRequest $request, $id)
    {
        $Companie = Companie::findOrFail($id);
        $Companie->update($request->except('_method', '_token'));

        return redirect()->route('admin.empresas.index')->with('success', 'Empresa atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Companie::find($id)->destroy($id);

        return redirect()->route('admin.empresas.index')->with('success', 'Empresa excluida com sucesso!');
    }
}
