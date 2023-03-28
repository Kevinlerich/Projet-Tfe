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
}
