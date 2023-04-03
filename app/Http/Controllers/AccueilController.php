<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use App\Models\Service;
use Illuminate\Http\Request;

class AccueilController extends Controller
{
    public function accueil()
    {
        $annonces = Announce::query()->get();
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

    public function contact()
    {
        return view('frontend.contact');
    }
}
