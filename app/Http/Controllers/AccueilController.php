<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use App\Models\Category;
use App\Models\Message;
use App\Models\Photo;
use App\Models\Portfolio;
use App\Models\RendezVous as ModelsRendezVous;
use App\Models\Service;
use App\Models\Ville;
use App\Notifications\Rendezvous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccueilController extends Controller
{
    public function accueil()
    {
        $annonces = Announce::query()->get();
        $services = Service::query()->orderBy('created_at', 'desc')->get();
        $categories = Category::query()->inRandomOrder()->get();
        $villes = Ville::query()->inRandomOrder()->get();

        return view('frontend.accueil', compact(
            'annonces', 'services',
            'categories', 'villes'));
    }

    public function search(Request $request)
    {
        $text = $request->input('text');
        $services = Service::query()->where('nom', 'like', '%'.$text.'%')
        ->orWhere('category_id', '=',$request->input('category_id'))
        ->orWhere('ville_id', '=',$request->input('ville_id'))
        ->orderBy('created_at', 'desc')
        ->get();
        return view('search', compact('services'));
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
        $portfolio = Portfolio::query()->where('service_id','=', $service->id)->first();
        $categories = Category::query()->inRandomOrder()->get();
        $villes = Ville::query()->inRandomOrder()->get();
        return view('frontend.detail_service',
         compact('service','categories', 'villes', 'portfolio'));
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

    public function contact_annonce($id)
    {
        /*$sms = Message::query()->create([
            'expediteur_id' => Auth::user()->id,
            'destinataire_id' => $request->destinataire_id,
            'objet' => $request->input('objet'),
            'contenu' => $request->input('contenu')
        ]);*/
        $sms = Service::query()->findOrFail($id);
        $sms->user->notify(new Rendezvous('Vous avez reçu un message.'));
        return back();
    }

    public function contact_service($id)
    {
        /*$sms = Message::query()->create([
            'expediteur_id' => Auth::user()->id,
            'destinataire_id' => $request->destinataire_id,
            'objet' => $request->input('objet'),
            'contenu' => $request->input('contenu')
        ]);
        dd($sms);*/
        $sms = Service::query()->findOrFail($id);
        $sms->user->notify(new Rendezvous('Vous avez reçu un message.'));
        //$sms->destinataire->notify(new Rendezvous('Vous avez reçu un message.'));
        return back();
    }

    public function ajax(Request $request)
    {
        switch ($request->type) {
            case 'add':
                 $event = ModelsRendezVous::create([
                     'debut' => $request->start,
                     'fin' => $request->end,
                 ]);

                 return response()->json($event);
             break;

             case 'update':
                 $event = ModelsRendezVous::query()->findOrFail($request->id)->update([
                     'debut' => $request->start,
                     'fin' => $request->end,
                 ]);

                 return response()->json($event);
             break;

             case 'delete':
                 $event = ModelsRendezVous::query()->findOrFail($request->id)->delete();

                 return response()->json($event);
             break;

             default:
             # code...
             break;
         }
    }
}
