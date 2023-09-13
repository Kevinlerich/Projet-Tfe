<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use App\Models\PhotographeProvince;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $villes = PhotographeProvince::query()->where('photographe_id', '=', Auth::user()->id)->get();

        /*$annonces = Announce::query()
                ->orderBy('created_at', 'desc')
                ->where('user_id', '!=', Auth::user()->id)
                ->get();*/
        /*$annonces = DB::table('announces')
                        ->join('photographe_provinces','announces.ville_id', '=', 'photographe_provinces.province_id')
                        ->join('users', 'announces.user_id', '!=', 'users.id')
                        ->select('announces.*')
                        ->get();*/
        $annonces = [];
        $viles = PhotographeProvince::query()->where('photographe_id', '=', Auth::user()->id)->get();
        if($viles){
            foreach ($viles as $ville) {
                $announces = Announce::query()->where('ville_id', '=', $ville->province_id)
                    ->where('archived', '!=', 1)
                    ->orderBy('created_at', 'desc')
                    ->get();
                array_push($annonces, ...$announces);
            }
        }
        $services = Service::query()
            ->orderBy('created_at', 'desc')
            ->get();
        return view('dashboard', compact('annonces', 'services'));
    }

    public function archive($id)
    {
        Announce::query()->where('id', '=', $id)->update(['archived' => 1]);
        return back();
    }
}
