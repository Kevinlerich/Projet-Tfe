<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Announce;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

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
        return view('backend.client.annonces.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // store photos
        $photo = $request->file('photo');
        if (!Storage::disk('public')->exists('annonces')) {
            Storage::makeDirectory('public/annonces', 0777);
        }
        $path = 'annonces/' . uniqid() . '.' . $photo->extension();
        Image::make($request->file('photo'))->resize(750, 500)->save(public_path() . "/storage/" .$path, 90);
        Announce::query()->create([
            'user_id' => Auth::user()->id,
            'category_id' => $request->input('category_id'),
            'titre' => $request->input('titre'),
            'slug' => Str::slug($request->input('titre')),
            'description' => $request->input('description'),
            'photo' => $path,
            'etat_annonce' => 0,
        ]);

        return back();
    }

    public function edit($id)
    {
        $annonce = Announce::query()->findOrFail($id);
        return view('backend.client.annonces.edit', compact('annonce'));
    }

    public function update(Request $request, $id)
    {
        Announce::query()->where('id', $id)->update([
            'user_id' => Auth::user()->id,
            'category_id' => $request->input('category_id'),
            'titre' => $request->input('titre'),
            'slug' => Str::slug($request->input('titre')),
            'description' => $request->input('description'),
        ]);
        return back();
    }

    public function delete($id)
    {
        Announce::query()->findOrFail($id)->delete();
        return back();
    }
}
