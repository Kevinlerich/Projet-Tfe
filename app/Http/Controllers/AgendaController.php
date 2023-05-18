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
            RendezVous::query()->where('photographe_id', Auth::user()->id)->first() :
            RendezVous::query()->where('client_id', Auth::user()->id)->first();
            $calendar_events = [];

            // Prepare JSON array for calender for use in the calender part of client and photographer
            foreach($agendas as $agenda) {
            $calendar_events = [
                'user' => Auth::user()->hasRole('photographe') ? $agenda->photographe->email : $agenda->client->email,
                'start' => $agenda->debut_8601,
                'end' => $agenda->fin_8601,
                'color' => '#4E558F',
            ];
        }
        $data = [
            'calendar_events' => json_encode($calendar_events)
        ];
        return view('backend.agenda.index', $data);
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
        $agenda->photographe->email->notify(new NotificationsRendezvous('Vous avez confirmé un rendez vous avec le client '. $agenda->client->email));
        $agenda->client->email->notify(new NotificationsRendezvous('Vous rendez-vous du '. $agenda->debut . ' au '. $agenda->fin . ' a été validé par le photographe '. $agenda->photographe->name));
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
