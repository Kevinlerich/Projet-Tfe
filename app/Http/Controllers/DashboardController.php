<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use App\Models\Service;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $annonces = Announce::query()->orderBy('created_at', 'desc')->get();
        $services = Service::query()->orderBy('created_at', 'desc')->get();
        return view('dashboard', compact('annonces', 'services'));
    }
}
