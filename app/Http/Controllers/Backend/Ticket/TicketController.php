<?php

namespace App\Http\Controllers\Backend\Ticket;

use Auth;
use Mail;
use App\User;
use App\Models\Ticket;
use App\Mail\TicketNovo;
use App\Mail\TicketFechado;
use Illuminate\Http\Request;
use App\Models\TicketComment;
use App\Mail\TicketRespondido;
use App\Http\Controllers\Controller;
use App\Notifications\DashboardNotification;
use App\Http\Requests\AdminTicketPostRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Tickets = Ticket::orderBy('status')->orderBy('created_at', 'desc')->with('user')->paginate(25);

        return view('backend.tickets.index', compact('Tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminTicketPostRequest $request)
    {
        $Ticket = new Ticket;
        $Ticket->titulo = $request->input('titulo');
        $Ticket->descricao = $request->input('descricao');
        $Ticket->tipo = $request->input('tipo');
        $Ticket->prioridade = $request->input('prioridade');
        $Ticket->user_id = Auth::getUser()->id;
        $Ticket->save();

        Mail::to(config('starter.MAIL_DEV'))->queue(new TicketNovo(Auth::getUser(), $Ticket));

        User::getSuper()->each(function ($item) use ($Ticket) {
            // Send Notification Dashboard
            $item->notify(new DashboardNotification([
                'title'      => "Novo Ticket: {$Ticket->titulo}",
                'body'       => $Ticket->descricao,
                'action_url' => route('admin.tickets.edit', $Ticket),
            ]));
        });

        return redirect()->route('admin.tickets.index')->with('success', 'Ticket aberto com sucesso!');
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
        $Ticket = Ticket::findOrFail($id);

        return view('backend.tickets.show', compact('Ticket'));
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
        $Ticket = Ticket::findOrFail($id);

        if ($Ticket->status != 'aberto') {
            return redirect()->back()->with('error', 'Ticket já fechado.');
        }

        return view('backend.tickets.edit', compact('Ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\RedirectResponse|null
     */
    public function update(Request $request, $id)
    {
        $Ticket = Ticket::findOrFail($id);

        if ($request->get('status')) {
            $Ticket->status = $request->get('status');
            $Ticket->save();

            Mail::to(config('starter.MAIL_DEV'))->queue(new TicketFechado(Auth::getUser(), $Ticket));

            return redirect()->route('admin.tickets.index')->with('success', 'Ticket fechado com sucesso!');
        }

        // Adiciona comentario ao ticket
        $Comentario = new TicketComment;
        $Comentario->comentario = $request->input('comentario');
        $Comentario->ticket_id = $Ticket->id;
        $Comentario->user_id = Auth::user()->id;
        $Comentario->save();

        // Aumenta o DevLoe do ticket
        $Ticket->increment('dev_loe');

        // Manda email de alerta ao dev
        Mail::to(config('starter.MAIL_DEV'))->queue(new TicketRespondido(Auth::getUser(), $Ticket, $Comentario));

        // Manda email ao usuario
        Mail::to($Ticket->User->email)->queue(new TicketRespondido(Auth::getUser(), $Ticket, $Comentario));

        // Dashboard notification
        $Ticket->User->notify(new DashboardNotification([
            'title'      => 'Ticket respondido',
            'body'       => $Comentario->comentario,
            'action_url' => route('admin.tickets.show', $Ticket),
        ]));

        return redirect()->route('admin.tickets.index')->with('success', 'Comentario adicionado ao Ticket.');
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
        return redirect()->back()->with('error', 'Função desabilitada.');
    }
}
