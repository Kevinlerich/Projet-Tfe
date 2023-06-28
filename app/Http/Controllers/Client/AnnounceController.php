<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Announce;
use App\Models\Category;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AnnounceController extends Controller
{
    public function index()
    {
        $announces = Announce::query()->where('user_id', Auth::user()->id)->get();
        return view('backend.client.annonces.index', compact('announces'));
    }

    public function create()
    {
        $categories = Category::query()->get();
        $villes = Ville::query()->get();
        return view('backend.client.annonces.create',
         compact('categories', 'villes'));
    }

    public function store(Request $request)
    {
        Announce::query()->create([
            'user_id' => Auth::user()->id,
            'category_id' => $request->input('category_id'),
            'titre' => $request->input('titre'),
            'slug' => Str::slug($request->input('titre')),
            'description' => $request->input('description'),
            'ville_id' => $request->input('ville_id'),
            'date_announce' => $request->input('date_announce'),
        ]);

        return redirect()->route('my_announces');
    }

    public function edit($id)
    {
        $annonce = Announce::query()->findOrFail($id);
        $categories = Category::query()->get();
        $villes = Ville::query()->get();
        return view('backend.client.annonces.edit',
         compact('annonce', 'villes','categories'));
    }

    public function update(Request $request, $id)
    {
        Announce::query()->where('id', $id)->update([
            'user_id' => Auth::user()->id,
            'category_id' => $request->input('category_id'),
            'titre' => $request->input('titre'),
            'slug' => Str::slug($request->input('titre')),
            'description' => $request->input('description'),
            'ville_id' => $request->input('ville_id'),
            'date_announce' => $request->input('date_announce'),
        ]);
        return redirect()->route('my_announces');
    }

    public function delete($id)
    {
        Announce::query()->findOrFail($id)->delete();
        return back();
    }
}
