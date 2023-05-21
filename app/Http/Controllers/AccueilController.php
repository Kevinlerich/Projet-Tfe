<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use App\Models\Category;
use App\Models\Disponibility;
use App\Models\Message;
use App\Models\Photo;
use App\Models\Portfolio;
use App\Models\RendezVous as ModelsRendezVous;
use App\Models\Service;
use App\Models\Ville;
use App\Notifications\Rendezvous;
use App\Notifications\SendMessage;
use App\Notifications\SendRendezVous;
use Carbon\Carbon;
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
        $services = Service::query()->where('category_id', '=',$request->input('category_id'))
        ->where('ville_id', '=',$request->input('ville_id'))
        ->orderBy('created_at', 'desc')
        ->get();
        $categories = Category::query()->get();
        $villes = Ville::query()->get();
        session()->flashInput($request->input());
        return view('frontend.search', compact('services', 'categories', 'villes'));
    }

    public function search_annonce(Request $request)
    {
        $text = $request->input('text');
        $annonces = Announce::query()->where('category_id', '=',$request->input('category_id'))
        ->where('ville_id', '=',$request->input('ville_id'))
        ->orderBy('created_at', 'desc')
        ->get();
        $categories = Category::query()->get();
        $villes = Ville::query()->get();
        session()->flashInput($request->input());
        return view('frontend.search_annonce',
         compact('annonces', 'categories',
          'villes'));
    }

    public function category_service($category_slug)
    {
        $categories = Category::query()->get();
        $villes = Ville::query()->get();
        $category = Category::query()->where('slug', $category_slug)->first();
        $services = Service::query()->where('category_id', '=', $category->id)->orderBy('created_at', 'desc')->get();
        return view('frontend.services', compact('services', 'categories', 'villes'));
    }

    public function category_annonce($category_slug)
    {
        $categories = Category::query()->get();
        $villes = Ville::query()->get();
        $category = Category::query()->where('slug', $category_slug)->first();
        $annonces = Announce::query()->where('category_id', '=', $category->id)->orderBy('created_at', 'desc')->get();
        return view('frontend.annonces', compact('annonces', 'categories', 'villes'));
    }

    public function services()
    {
        $services = Service::query()->get();
        $categories = Category::query()->inRandomOrder()->get();
        $villes = Ville::query()->inRandomOrder()->get();
        return view('frontend.services',
         compact('services', 'categories', 'villes'));
    }

    public function annonces()
    {
        $annonces = Announce::query()->orderBy('created_at', 'desc')->get();
        $categories = Category::query()->inRandomOrder()->get();
        $villes = Ville::query()->inRandomOrder()->get();
        return view('frontend.annonces', compact('annonces',
         'categories', 'villes'));
    }

    public function detail_service($slug)
    {
        $service = Service::query()->where('slug', $slug)->first();
        $portfolio = Portfolio::query()->where('service_id','=', $service->id)->first();
        $categories = Category::query()->inRandomOrder()->get();
        $villes = Ville::query()->inRandomOrder()->get();
        $disponibilities = Disponibility::query()->where('user_id', '=', $service->user->id)->get();
        $calendar_books = [];
        foreach($disponibilities as $dispo)
        {
            $calendar_books[] = [
                'start' => Carbon::parse($dispo->debut),
                'end' => Carbon::parse($dispo->fin)
            ];
        }
        $data = [
            'categories' => $categories,
            'villes' => $villes,
            'service' => $service,
            'disponibilities' => json_encode($calendar_books),
            'portfolio' => $portfolio
        ];
        //dd($data);
        return view('frontend.detail_service', $data);
    }

    public function detail_annonce($slug)
    {
        $annonce = Announce::query()->where('slug', $slug)->first();
        $categories = Category::query()->inRandomOrder()->get();
        $villes = Ville::query()->inRandomOrder()->get();
        return view('frontend.detail_annonce',
        compact('annonce', 'villes', 'categories'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function contact_annonce(Request $request)
    {
        $annonce = Announce::query()->findOrFail($request->input('objet'));
        $sms = Message::query()->create([
            'expediteur_id' => Auth::user()->id,
            'destinataire_id' => $request->input('destinataire_id'),
            'objet' => $annonce->titre,
            'contenu' => $request->input('message')
        ]);
        $sms->destinataire->notify(new SendMessage('Vous avez reçu un message: '.$sms->contenu.'', $sms->id));
        return back();
    }

    public function contact_service(Request $request)
    {
        $service = Service::query()->findOrFail($request->input('objet'));
        $sms = Message::query()->create([
            'expediteur_id' => Auth::user()->id,
            'destinataire_id' => $request->input('destinataire_id'),
            'objet' => $service->nom,
            'contenu' => $request->input('contenu')
        ]);
        $sms->destinataire->notify(new SendMessage('Vous avez reçu un message: '.$sms->contenu.'', $sms->id));
        return back();
    }

    public function ajax(Request $request)
    {
        switch ($request->type) {
            case 'add':
                 $event = ModelsRendezVous::create([
                    'client_id'=> Auth::user()->id,
                    'photographe_id' => $request->photographe_id,
                    'service_id' => $request->service_id,
                     'debut' => $request->start,
                     'fin' => $request->end,
                     'message' => $request->message,
                     'etat' => 0
                 ]);
                 $service = Service::query()->findOrFail($request->service_id);
                 $event->photographe->notify(new SendRendezVous('Vous avez un nouveau rendez-vous dans la plateforme.', $service->slug));

                 return response()->json($event);
             break;

             case 'update':
                 $event = ModelsRendezVous::query()->findOrFail($request->id)->update([
                     'debut' => $request->start,
                     'fin' => $request->end,
                     'message' => $request->message,
                     'etat' => 0
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
