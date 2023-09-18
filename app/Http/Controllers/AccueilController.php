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
        $startWeek = Carbon::now()->subWeek()->startOfWeek();
        $month = Carbon::now()->subMonth();
        $yesterday = Carbon::yesterday();
        $today = Carbon::today();
        $endWeek = Carbon::now()->subWeek()->endOfWeek();
        $category = $request->input('category_id');
        $ville = $request->input('ville_id');

        if ($request->input('date') == 'one week')
        {
            $annonces = Announce::query()
                ->orWhere('category_id', '=',$request->input('category_id'))
                ->orWhere('ville_id', '=',$request->input('ville_id'))
                ->where('archived', '=', 0)
                ->whereBetween('date_announce', [$startWeek, $endWeek])
                ->orderBy('date_announce', 'desc')
                ->get();
        } elseif($request->input('date') == 'one month') {
            $annonces = Announce::query()
                ->orWhere('category_id', '=',$request->input('category_id'))
                ->orWhere('ville_id', '=',$request->input('ville_id'))
                ->orWhere('date_announce', '<', $month)
                ->where('archived', '=', 0)
                ->orderBy('date_announce', 'desc')
                ->get();
        } elseif($request->input('date') == 'today') {
            $annonces = Announce::query()
                ->orWhere('category_id', '=',$request->input('category_id'))
                ->orWhere('ville_id', '=',$request->input('ville_id'))
                ->orWhere('date_announce', '=', $today->format('Y-m-d'))
                ->where('archived', '=', 0)
                //->orderBy('date_announce', 'desc')
                ->get();
        } elseif($request->input('date') == 'yesterday') {
            $annonces = Announce::query()
                ->orWhere('category_id', '=',$request->input('category_id'))
                ->orWhere('ville_id', '=',$request->input('ville_id'))
                ->orWhere('date_announce', '<=', $yesterday->format('Y-m-d'))
                ->where('archived', '=', 0)
                ->get();
        } elseif(isset($category) && is_numeric($category)) {
            $annonces = Announce::query()
                ->where('archived', '=', 0)
                ->where('category_id', '=',$request->input('category_id'))
                ->orWhere('ville_id', '=',$request->input('ville_id'))
                ->orderBy('date_announce', 'desc')
                ->get();
        } elseif (isset($ville) && is_numeric($ville)) {
            $annonces = Announce::query()
                ->orWhere('category_id', '=',$request->input('category_id'))
                ->where('ville_id', '=',$request->input('ville_id'))
                ->where('archived', '=', 0)
                ->orderBy('date_announce', 'desc')
                ->get();
        }else{
            $annonces = Announce::query()
                ->where('archived', '=', 0)
                ->orderBy('date_announce', 'desc')
                ->get();
        }

        $categories = Category::query()->get();
        $villes = Ville::query()->get();
        session()->flashInput($request->input());
        return view('frontend.search_annonce', compact('annonces', 'categories', 'villes'));
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
        if (Auth::user()) {
            if (Auth::user()->hasRole('photographe')){
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
        //$photos = Photo::query()->where('port')
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
}
