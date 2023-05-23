<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use App\Models\User;
use App\Notifications\Rendezvous as NotificationsRendezvous;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Auth::user()->hasRole('photographe') ?
            RendezVous::query()->with('scheduler')->where('photographe_id', Auth::user()->id)->orderBy('date_appointment','desc')->get() :
            RendezVous::query()->with('scheduler')->where('client_id', Auth::user()->id)->orderBy('date_appointment','desc')->get();
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
        $rdv = RendezVous::query()->create([
            'client_id' => Auth::user()->id,
            'photographe_id' => $request->input('photographe_id'),
            'debut' => $request->input('debut'),
            'fin' => $request->input('fin'),
            'etat' => 0,
        ]);
        $rdv->photographe->notify(new NotificationsRendezvous('Vous avez reçu une nouvelle date de rendez vous avec un client sur notre plateforme.'));
        $rdv->client->notify(new NotificationsRendezvous('Vous avez programmé un rendezvous avec le photographe '.$rdv->photographe->email));
        session()->flash('message', 'Vous avez ajouté un nouvel agenda');
        return redirect()->route('my_agenda');
    }

    public function confirmer($agenda_id)
    {
        $agenda = RendezVous::query()->findOrFail($agenda_id);
        $agenda->etat = $agenda->etat == 1 ? 0 : 1;
        $agenda->save();
        $agenda->photographe->notify(new NotificationsRendezvous('Vous avez confirmé un rendez vous avec le client '. $agenda->client->email));
        $agenda->client->notify(new NotificationsRendezvous('Votre rendez-vous du '. $agenda->debut . ' au '. $agenda->fin . ' a été validé par le photographe '. $agenda->photographe->name. '. Confirmer votre participation en cliquant sur le bouton ci-dessous.'));
        return back();
    }

    public function edit($id)
    {
        $agenda = RendezVous::query()->findOrFail($id);
        $photographes = User::query()->role('photographe')->get();
        return view('backend.agenda.edit', compact('agenda', 'photographes'));
    }

    public function update(Request $request, $id)
    {
        RendezVous::query()->where('id', $id)->update([
            'client_id' => Auth::user()->id,
            'photographe_id' => $request->input('photographe_id'),
            'debut' => $request->input('debut'),
            'fin' => $request->input('fin'),
            'etat' => 0,
        ]);
        session()->flash('message', 'Vous avez ajouté un nouvel agenda');
        return redirect()->route('my_agenda');
    }

    public function delete($id)
    {
        RendezVous::query()->findOrFail($id)->delete();
        return back();
    }
}
