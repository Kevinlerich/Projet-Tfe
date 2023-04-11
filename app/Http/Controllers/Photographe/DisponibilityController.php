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
        //
    }

    public function edit($id)
    {
        return view('backend.photographe.disponibility.edit');
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
