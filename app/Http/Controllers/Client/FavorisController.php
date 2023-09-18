<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChFavorite;
use App\Models\Service;
use App\Models\Ville;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavorisController extends Controller
{
    public function index()
    {
        $favoris = ChFavorite::query()->where('user_id', Auth::user()->id)->get();
        return view('backend.client.favoris.index', compact('favoris'));
    }

    public function destroy($id)
    {
        $favoris = ChFavorite::query()->findOrFail($id);
        $favoris->delete();
        Toastr::success('notification','Favoris supprime avec succes');
        return back();
    }

    public function services($id)
    {
        $services = Service::query()->where('user_id', $id)->get();
        $categories = Category::query()->inRandomOrder()->get();
        $villes = Ville::query()->inRandomOrder()->get();
        return view('frontend.services',
            compact('services', 'categories', 'villes'));
    }
}
