<?php

namespace App\Http\Controllers\Photographe;

use App\Http\Controllers\Controller;
use App\Models\Disponibility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisponibilityController extends Controller
{
    public function index()
    {
        $disponibilities = Disponibility::query()->where('user_id', Auth::user()->id)->get();
        return view('backend.photographe.disponibility.index', compact('disponibilities'));
    }

    public function create()
    {
        return view('backend.photographe.disponibility.create');
    }

    public function store(Request $request)
    {
        Disponibility::query()->create([
            'user_id' => Auth::user()->id,
            'jours' => $request->input('jours'),
            'mois' => $request->input('mois'),
            'debut' => $request->input('debut'),
            'fin' => $request->input('fin'),
            'etat' => $request->input('etat'),
        ]);
        session()->flash('message', 'Vous avez ajouté une nouvelle disponibilité');
        return redirect()->route('my_disponibilities');
    }

    public function edit($id)
    {
        $disponibility = Disponibility::query()->findOrFail($id);
        return view('backend.photographe.disponibility.edit', compact('disponibility'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function delete($id)
    {
        Disponibility::query()->findOrFail($id)->delete();
        return back();
    }
}
