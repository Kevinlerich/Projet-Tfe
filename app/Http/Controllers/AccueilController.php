<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use App\Models\Service;
use Illuminate\Http\Request;

class AccueilController extends Controller
{
    public function accueil()
    {
        $annonces = Announce::query()->where('etat_annonce', '=', 1)->get();
        $services = Service::query()->get();

        return view('frontend.accueil', compact('annonces', 'services'));
    }

    public function services()
    {
        $services = Service::query()->get();
        return view('frontend.services', compact('services'));
    }

    public function detail_service($id)
    {
        $service = Service::query()->findOrFail($id);
        return view('frontend.detail_service', compact('service'));
    }

    public function detail_annonce($slug)
    {
        $annonce = Announce::query()->where('slug', $slug)->first();
        return view('frontend.detail_annonce', compact('annonce'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}
