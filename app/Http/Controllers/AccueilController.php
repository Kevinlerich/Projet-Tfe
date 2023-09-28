<?php

namespace App\Http\Controllers;

use App\Mail\NotifAnnonce;
use App\Mail\Notification;
use App\Models\Announce;
use App\Models\Category;
use App\Models\ChFavorite;
use App\Models\Photo;
use App\Models\PhotographeProvince;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\User;
use App\Models\Ville;
use App\Notifications\SendMessage;
use App\Notifications\SendService;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Chatify\Facades\ChatifyMessenger as Chatify;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        $query = Announce::query();//DB::table('announces');

        // Filtre par catégorie
        if ($request->has('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        // Filtre par ville
        if ($request->has('ville_id')) {
            $query->where('ville_id', $request->input('ville_id'));
        }

        // Filtre par date
        if ($request->has('date')) {
            $dateFilter = $request->input('date');

            // En fonction de la valeur du sélecteur de date, ajustez la condition de recherche
            if ($dateFilter == \Carbon\Carbon::today()) {
                $query->whereDate('date_announce', \Carbon\Carbon::today());
            } elseif ($dateFilter == \Carbon\Carbon::yesterday()) {
                $query->whereDate('date_announce', \Carbon\Carbon::yesterday());
            } elseif ($dateFilter == \Carbon\Carbon::now()->subMonth()) {
                $query->whereDate('date_announce', '>=', \Carbon\Carbon::now()->subMonth());
            }
        }

        $query->where('archived', '=', 0);
        $query->orderBy('date_announce', 'desc');

        $annonces = $query->get();

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
        if (Auth::user()){
            $favoris = ChFavorite::query()->where('favorite_id', $service->user_id)
                ->where('user_id', Auth::user()->id)->get();
            $data = [
                'categories' => $categories,
                'villes' => $villes,
                'service' => $service,
                'portfolio' => $portfolio,
                'lieux' => $lieux,
                'favoris' => $favoris,
            ];
        } else {
            $data = [
                'categories' => $categories,
                'villes' => $villes,
                'service' => $service,
                'portfolio' => $portfolio,
                'lieux' => $lieux,
            ];
        }
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
        $annonce_id = $request->input('annonce_id');
        $annonce = Announce::query()->findOrFail($annonce_id);
        $message = Chatify::newMessage([
            'from_id' => Auth::user()->id,
            'to_id' => $request->input('to_id'),
            'body' => 'L\'annonce '.route('detail_annonce', $annonce->slug). 'Message: '. htmlentities(trim($request->input('message')), ENT_QUOTES, 'UTF-8'),
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
            $user = User::findOrFail($request->input('to_id'));
        Mail::to($user->email)->queue(new NotifAnnonce($message->id, $annonce_id));

        //$user->notify(new SendService('Vous avez reçu un message dont le contenu est: '.$message->body.' concernant l\'annonce: <a href="'.route('detail_annonce', $annonce->slug).'">Lien vers le détail du service</a>', $user->id, $annonce));

        Toastr::success('notification', 'Votre message a ete envoye avec succes');
        return back();
    }

    public function contact_service(Request $request)
    {
        $service_id = $request->input('service_id');
        $service = Service::query()->findOrFail($service_id);
        $message = Chatify::newMessage([
            'from_id' => Auth::user()->id,
            'to_id' => $request->input('to_id'),
            'body' => 'Le service '. route('detail_service', $service->slug). ' et le Message: '.htmlentities(trim($request->input('message')), ENT_QUOTES, 'UTF-8'),
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
        $user = User::findOrFail($request->input('to_id'));
        Mail::to($user->email)->queue(new Notification($message->id, $service_id));
        //$user->notify(new SendService('Vous avez reçu un message dont le contenu est: '.$message->body.' concernant le service: <a href="'.route('detail_service', $service->slug).'">Lien vers le détail du service</a>', $user->id, $service));
        Toastr::success('notification', 'Votre message a ete envoye avec succes');
        return back();
    }

    public function ajouter_favoris(Request $request, $id)
    {
        ChFavorite::query()->updateOrCreate([
            'user_id' => Auth::user()->id,
            'favorite_id' => $id
        ]);
        Toastr::success('notification', 'Photographe ajoute avec succes');
        return back();
    }

    public function retirer_favoris(Request $request, $id)
    {
        $fav = ChFavorite::query()->findOrFail($id);
        $fav->delete();
        Toastr::success('notification', 'Photographe retirer avec succes');
        return back();
    }
}
