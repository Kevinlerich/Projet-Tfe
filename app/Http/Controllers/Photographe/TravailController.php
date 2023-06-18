<?php

namespace App\Http\Controllers\Photographe;

use App\Http\Controllers\Controller;
use App\Models\PhotographeProvince;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TravailController extends Controller
{
    public function index()
    {
        $travails = PhotographeProvince::query()->where('photographe_id', '=', Auth::user()->id)->get();
        return view('backend.photographe.travail.index', compact('travails'));
    }

    public function create()
    {
        $provinces = Ville::query()->orderBy('nom', 'DESC')->get();
        return view('backend.photographe.travail.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        PhotographeProvince::query()->create($request->all());
        return redirect()->route('list_travails');
    }

    public function edit($id)
    {
        $photographe_province = PhotographeProvince::query()->findOrFail($id);
        $provinces = Ville::query()->orderBy('nom', 'DESC')->get();
        return view('backend.photographe.travail.edit', compact('photographe_province', 'provinces'));
    }

    public function update(Request $request, $id)
    {
        PhotographeProvince::query()->where('id', $id)->update($request->except(['_token','_method']));
        return redirect()->route('list_travails');
    }

    public function destroy($id)
    {
        PhotographeProvince::query()->findOr($id)->delete();
        return back();
    }
}
