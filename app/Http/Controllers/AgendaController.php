<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Auth::user()->hasRole('photographe') ?
            RendezVous::query()->where('photographe_id', Auth::user()->id)->get() :
            RendezVous::query()->where('client_id', Auth::user()->id)->get();
        return view('backend.agenda.index', compact('agendas'));
    }

    public function create()
    {
        /* retourne tous les utilisateurs ayant le rôle de photographe dans la
         table users */
        $photographes = User::query()->role('photographe')->get();
        return view('backend.agenda.create', compact('photographes'));
    }
    public function store(Request $request)
    {
        RendezVous::query()->create([
            'client' => Auth::user()->id,
            'photographe' => $request->input('photographe_id'),
            'jours' => $request->input('jours'),
            'mois' => $request->input('mois'),
            'debut' => $request->input('debut'),
            'fin' => $request->input('fin'),
            'etat' => 0,
        ]);
        session()->flash('message', 'Vous avez ajouté un nouvel agenda');
        return redirect()->route('my_agenda');
    }

    public function edit($id)
    {
        $agenda = RendezVous::query()->findOrFail($id);
        return view('backend.agenda.edit', compact('agenda'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function delete($id)
    {
        RendezVous::query()->findOrFail($id)->delete();
        return back();
    }
}
