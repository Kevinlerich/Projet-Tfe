<?php

namespace App\Http\Controllers\Photographe;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use App\Models\Ville;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::query()->where('user_id', Auth::user()->id)->get();
        return view('backend.photographe.services.index', compact('services'));
    }

    public function create()
    {
        $categories = Category::query()->get();
        $villes = Ville::query()->get();
        return view('backend.photographe.services.create',
         compact('categories', 'villes'));
    }

    public function store(Request $request)
    {
        $photo = $request->file('image_service');
        if (!Storage::disk('public')->exists( 'services')) {
            Storage::makeDirectory('public/services', 0777);
        }
        $path = 'services/' . uniqid() . '.' . $photo->extension();
        Image::make($request->file('image_service'))->resize(750, 500)->save(public_path() . "/storage/" .$path, 90);
        Service::query()->create([
            'user_id' => Auth::user()->id,
            'nom' => $request->input('nom'),
            'slug' => Str::slug($request->input('nom')),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'image_service' => $path,
            'ville_id' => $request->input('ville_id'),
        ]);
        Toastr::success('notification', 'Ajoute avec succes');

        return redirect()->route('list_service');
    }

    public function edit($id)
    {
        $service = Service::query()->findOrFail($id);
        $categories = Category::query()->get();
        $villes = Ville::query()->get();
        return view('backend.photographe.services.edit',
         compact('categories', 'service', 'villes'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::query()->findOrFail($id);

        if ($request->hasFile('image_service')) {
            $photo = $request->file('image_service');

            $path = 'services/' . uniqid() . '.' . $photo->extension();
            Image::make($photo)->resize(750, 500)->save(public_path() . "/storage/" .$path, 90);
            $service->image_service = $path;
        }

        $service->category_id = $request->input('category_id');
        $service->nom = $request->input('nom');
        $service->slug = Str::slug($request->input('nom'));
        $service->description = $request->input('description');
        $service->ville_id = $request->input('ville_id');
        $service->save();
        Toastr::success('notification', 'Modifie avec succes');

        return redirect()->route('list_service');
    }

    public function delete($id)
    {
        $service = Service::query()->findOrFail($id);
        $service->delete();
        Toastr::success('notification', 'Supprime avec succes');

        return back();
    }
}
