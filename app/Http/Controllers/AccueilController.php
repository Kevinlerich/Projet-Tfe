<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use App\Models\Category;
use App\Models\Message;
use App\Models\Photo;
use App\Models\PhotographeProvince;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Ville;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Chatify\Facades\ChatifyMessenger as Chatify;

class AccueilController extends Controller
{
    public function accueil()
    {
        $annonces = Announce::query()->where('archived', '!=', 1)->get();
        $services = Service::query()->orderBy('created_at', 'desc')->get();
        $categories = Category::query()->inRandomOrder()->get();
        $villes = Ville::query()->inRandomOrder()->get();

        return view('frontend.accueil', compact(
            'annonces', 'services',
            'categories', 'villes'));
    }

    public function search(Request $request)
    {
        $services = Service::query()->orWhere('category_id', '=',$request->input('category_id'))
            ->orWhere('ville_id', '=',$request->input('ville_id'))
            ->orderBy('created_at', 'desc')
            ->get();
        //->Where('id', '=',$request->input('portfolio_id'))
        $categories = Category::query()->get();
        $villes = Ville::query()->get();
        session()->flashInput($request->input());
        return view('frontend.search', compact('services', 'categories', 'villes'));
    }

    public function search_annonce(Request $request)
    {
        $text = $request->input('text');
        $startWeek = Carbon::now()->subWeek()->startOfWeek();
        $month = Carbon::now()->subMonth();
        $yesterday = Carbon::yesterday();
        $today = Carbon::today();
        $endWeek = Carbon::now()->subWeek()->endOfWeek();
        $category = $request->input('category_id');
        $ville = $request->input('ville_id');

        if ($request->input('date') == 'one week')
        {
            $annonces = Announce::query()->Where('category_id', '=',$request->input('category_id'))
        ->Where('ville_id', '=',$request->input('ville_id'))
        ->WhereBetween('created_at', [$startWeek, $endWeek])
        ->get();
        } elseif($request->input('date') == 'one month') {
            $annonces = Announce::query()->orWhere('category_id', '=',$request->input('category_id'))
        ->Where('ville_id', '=',$request->input('ville_id'))
        ->Where('created_at', '<', $month)
        ->get();
        } elseif($request->input('date') == 'today') {
            $annonces = Announce::query()->Where('category_id', '=',$request->input('category_id'))
        ->Where('ville_id', '=',$request->input('ville_id'))
        ->Where('created_at', '<=', $today)
        ->get();
        } elseif($request->input('date') == 'yesterday') {
            $annonces = Announce::query()->Where('category_id', '=',$request->input('category_id'))
        ->Where('ville_id', '=',$request->input('ville_id'))
        ->Where('created_at', '<=', $yesterday)
        ->get();
        } else {
            $annonces = Announce::query()->Where('category_id', '=',$request->input('category_id'))
        ->Where('ville_id', '=',$request->input('ville_id'))
        ->get();
        }

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
        if (Auth::user()->hasRole('photographe')) {
            $annonces = [];
            $viles = PhotographeProvince::query()->where('photographe_id', '=', Auth::user()->id)->get();
            foreach ($viles as $ville) {
                $announces = Announce::query()->where('ville_id', '=', $ville->province_id)
                                        ->where('archived', '!=', 1)
                                        ->orderBy('created_at', 'desc')
                                        ->get();
                array_push($annonces, ...$announces);
            }
            $categories = Category::query()->inRandomOrder()->get();
            $villes = Ville::query()->inRandomOrder()->get();
            return view('frontend.annonces', compact('annonces',
                'categories', 'villes'));
        } else {
            $annonces = Announce::query()->where('archived', '!=', 1)
                ->orderBy('created_at', 'desc')->get();
            $categories = Category::query()->inRandomOrder()->get();
            $villes = Ville::query()->inRandomOrder()->get();
            return view('frontend.annonces', compact('annonces',
                'categories', 'villes'));
        }
    }

    public function detail_service($slug)
    {
        $service = Service::query()->where('slug', $slug)->first();
        $portfolio = Portfolio::query()->where('service_id','=', $service->id)->first();
        $categories = Category::query()->inRandomOrder()->get();
        $villes = Ville::query()->inRandomOrder()->get();
        $lieux = PhotographeProvince::query()->where('photographe_id','=', $service->user_id)->get();
        $data = [
            'categories' => $categories,
            'villes' => $villes,
            'service' => $service,
            'portfolio' => $portfolio,
            'lieux' => $lieux,
        ];
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
        //$annonce = Announce::query()->findOrFail($request->input('objet'));
        $message = Chatify::newMessage([
            'from_id' => Auth::user()->id,
            'to_id' => $request->input('to_id'),
            'body' => htmlentities(trim($request->input('message')), ENT_QUOTES, 'UTF-8'),
            'attachment' =>  null,
        ]);
        $messageData = Chatify::parseMessage($message);
            if (Auth::user()->id != $request['id']) {
                Chatify::push("private-chatify.".$request->input('to_id'), 'messaging', [
                    'from_id' => Auth::user()->id,
                    'to_id' => $request->input('to_id'),
                    'message' => Chatify::messageCard($messageData, true)
                ]);
            }
        //$sms->destinataire->notify(new SendMessage('Vous avez reçu un message: '.$sms->contenu.'', $sms->id));
        return back();
    }

    public function contact_service(Request $request)
    {
        $message = Chatify::newMessage([
            'from_id' => Auth::user()->id,
            'to_id' => $request->input('to_id'),
            'body' => htmlentities(trim($request->input('message')), ENT_QUOTES, 'UTF-8'),
            'attachment' =>  null,
        ]);
        $messageData = Chatify::parseMessage($message);
            if (Auth::user()->id != $request['id']) {
                Chatify::push("private-chatify.".$request->input('to_id'), 'messaging', [
                    'from_id' => Auth::user()->id,
                    'to_id' => $request->input('to_id'),
                    'message' => Chatify::messageCard($messageData, true)
                ]);
            }
        return back();
    }

    /*public function ajax(Request $request)
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

    public function index(Request $request): JsonResponse
    {
        $data_date=Carbon::createFromFormat('Y-m-d',$request->date)->format('Y-m-d');
        $disponibilities = Disponibility::query()
            ->where('jours','<=', $request->date)
            ->where('jours_end','>=', $request->date)
            ->pluck('id');

        if ($disponibilities->count() == 0){
            $data = [];//Scheduler::query()->get();
        } else {
            $data = Scheduler::query()
                ->where('disponibility_id','=', $disponibilities)
                ->get();
        }

        if ($data_date == now()->format('Y-m-d')) {
            $hn = now()->format('H');

            $return = [];
            foreach ($data as $d) {
                $h = explode(':', $d->debut)[0];
                if ($h > $hn) {
                    $return[] = $d;
                }
            }
            return response()->json($return);
        } else {
            return response()->json($data);
        }
    }

    public function store_rdv(Request $request)
    {
        $time = Scheduler::query()->findOrFail($request->schedule);
        $time2 = Scheduler::query()->findOrFail($request->schedule2);
        $event = ModelsRendezVous::create([
            'client_id'=> Auth::user()->id,
            'photographe_id' => $request->photographe_id,
            'service_id' => $request->service_id,
             'date_appointment' => $request->date_appointment,
             'message' => $request->message,
             'heure_debut' => $time->start,
             'heure_fin' => $time->end,
             'etat' => 0,
             'contrat' => 0
         ]);
        //$service = Service::query()->findOrFail($request->service_id);
        $event->photographe->notify(new Rendezvous('Vous avez un nouveau rendez-vous dans la plateforme.'));
        //$event->client->notify(new SendRendezVous('Votre rendez-vous a été accepté par le photographe. Cliquer sur le lien ci-dessous pour valider le contrat.', $event->id));
    }*/
}
