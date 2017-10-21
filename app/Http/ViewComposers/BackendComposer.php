<?php

namespace App\Http\ViewComposers;

use Carbon\Carbon;
use App\Models\Alert;
use App\Models\Companie;
use Illuminate\Contracts\View\View;

class BackendComposer
{
    private $alertas;
    private $listaEmpresas;

    public function __construct()
    {
        if (auth()->user()->is_super) {
            $this->listaEmpresas = Companie::get();
        } else {
            $this->listaEmpresas = auth()->user()->Empresas;
        }

        $this->alertas = Alert::where('start_at', '<=', Carbon::now()->format('Y-m-d'))->where('end_at', '>=', Carbon::now()->format('Y-m-d'))->first();
    }

    public function compose(View $view)
    {
        return $view->with('alertas', $this->alertas)->with('listaEmpresas', $this->listaEmpresas);
    }
}
