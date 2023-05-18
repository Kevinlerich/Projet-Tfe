<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use App\Models\Category;
use App\Models\Message;
use App\Models\Service;
use App\Notifications\Rendezvous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccueilController extends Controller
{
    public function accueil()
    {
        $annonces = Announce::query()->get();
        $services = Service::query()->get();
        $categories = Category::query()->inRandomOrder()->get();

        return view('frontend.accueil', compact(
            'annonces', 'services', 'categories'));
    }

    public function category_service($category_slug)
    {
        $services = Service::query()->where('category_id', '=', $category_slug)->orderBy('created_at', 'desc')->get();
        return view('services', compact('services'));
    }

    public function services()
    {
        $services = Service::query()->get();
        return view('frontend.services', compact('services'));
    }

    public function annonces()
    {
        $annonces = Announce::query()->orderBy('created_at', 'desc')->get();
        return view('frontend.annonces', compact('annonces'));
    }

    public function detail_service($slug)
    {
        $service = Service::query()->where('slug', $slug)->first();
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

    public function contact_annonce(Request $request)
    {
        $sms = Message::query()->create([
            'expediteur_id' => Auth::user()->id,
            'destinataire_id' => $request->destinataire_id,
            'objet' => $request->input('objet'),
            'contenu' => $request->input('contenu')
        ]);
        $sms->destinataire->notify(new Rendezvous('Vous avez reçu un message.'));
        return back();
    }

    public function contact_service(Request $request)
    {
        $sms = Message::query()->create([
            'expediteur_id' => Auth::user()->id,
            'destinataire_id' => $request->destinataire_id,
            'objet' => $request->input('objet'),
            'contenu' => $request->input('contenu')
        ]);
        dd($sms);
        //$sms->destinataire->notify(new Rendezvous('Vous avez reçu un message.'));
        return back();
    }
}
