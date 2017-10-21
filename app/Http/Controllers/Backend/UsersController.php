<?php

namespace App\Http\Controllers\Backend;

use Auth;
use App\User;
use DateTime;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\Companie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserPostRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Usuarios = User::orderBy('name', 'ASC')->where('company_id', auth()->user()->company_id)->with('companie', 'profile');

        if ($request->filter) {
            // Separa o filtro
            $filter = explode(':', $request->filter);

            // Busca por Email
            if (starts_with(strtolower($request->filter), 'email')) {
                $Usuarios = $Usuarios->where('email', 'like', '%'.$filter[1].'%');
            }
            // Busca por Nome
            if (starts_with(strtolower($request->filter), 'nome')) {
                $Usuarios = $Usuarios->where('name', 'like', '%'.$filter[1].'%');
            }
            // Busca por Ultimo Login
            if (starts_with(strtolower($request->filter), 'lastlogin')) {
                // validar data
                $d = DateTime::createFromFormat('d/m/Y', $filter[1]);
                if ($d) {
                    $Data = Carbon::createFromFormat('d/m/Y', $filter[1]);
                    $Usuarios = $Usuarios->whereBetween('last_login', [$Data->startOfDay(), $Data->parse()]);
                }
            }
        }

        // Merge
        $Usuarios = $Usuarios->paginate(75);

        return view('backend.usuarios.index', compact('Usuarios'));
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
        $Usuario = User::findOrFail($id);
        $Roles = Role::get();

        return view('backend.usuarios.edit', compact('Usuario', 'Roles'));
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
        $Usuario = User::findOrFail($id);
        $Roles = Role::get();

        return view('backend.usuarios.edit', compact('Usuario', 'Roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminUserPostRequest $request, $id)
    {
        $Usuario = User::findOrFail($id);
        $Usuario->update($request->except('_method', '_token', 'roles', 'email'));

        // Vincula usuario a empresa atual
        $Usuario->Empresas()->sync([$request->user()->Companie->id]);

        // Ativa usuario se solicitado
        if ($request->activate) {
            $Usuario->activation = 1;
            $Usuario->activation_code = null;
            $Usuario->save();

            return redirect()->route('admin.usuarios.index')->with('success', 'Usuário ativado com sucesso!');
        }

        // Bloqueia usuario
        if ($request->suspend) {
            $Usuario->suspender($request->suspend);

            return redirect()->route('admin.usuarios.index')->with('success', 'Suspensão aplicada com sucesso!');
        }

        $Usuario->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario atualizado com sucesso!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminUserPostRequest $request)
    {
        $token = hash_hmac('sha256', str_random(60), config('app.key'));

        try {
            $Usuario = new User;
            $Usuario->name = $request->input('name');
            $Usuario->email = $request->input('email');
            $Usuario->password = bcrypt($request->input('password'));
            $Usuario->activation_code = $token;
            $Usuario->save();

            // Vincula o usuario a empresa
            $Usuario->Empresas()->sync([auth()->user()->Companie->id]);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with('error', 'Erro no sistema!');
        }

        // Dispara email
        $Usuario->sendUserConfirmationNotification($token);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario cadastrado com sucesso!');
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
        $Usuario = User::findOrFail($id);

        if ($Usuario->is_admin) {
            return redirect()->route('admin.usuarios.index')->with('warning', 'Usuario administrador, não é possivel excluir!');
        }

        User::destroy($id);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario excluido com sucesso!');
    }
}
