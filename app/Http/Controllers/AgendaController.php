<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
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
        return view('backend.agenda.create');
    }
    public function store(Request $request)
    {
        //
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
