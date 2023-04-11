<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Announce;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Image;

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
        $galleries = $request->file('gallerie');
        if (!Storage::disk('public')->exists('annonces')) {
            Storage::makeDirectory('public/annonces', 0777);
        }
        $path = 'annonces/' . uniqid() . '.' . $photo->extension();
        Image::make($request->file('photo'))->resize(750, 500)->save(public_path() . "/storage/" .$path, 90);
        $annonce = Announce::query()->create([
            'user_id' => Auth::user()->id,
            'category_id' => $request->input('category_id'),
            'titre' => $request->input('titre'),
            'slug' => Str::slug($request->input('titre')),
            'description' => $request->input('description'),
            'photo' => $path
        ]);
        if ($galleries) {
            foreach ($galleries as $gallery) {
                $path2 = 'annonces/' . uniqid() . '.' . $gallery->extension();
                Image::make($request->file('photo_path'))->resize(750, 500)->save(public_path() . "/storage/" .$path2, 90);
                Gallery::query()->create([
                    'announce_id' => $annonce->id,
                    'photo_path' => $path2
                ]);
            }
        }

        return back();
    }

    public function edit($id)
    {
        $annonce = Announce::query()->findOrFail($id);
        return view('backend.client.annonces.edit', compact('annonce'));
    }
}
