<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $annonces = Announce::query()->get();
        $services = Announce::query()->get();
        return view('dashboard', compact('annonces', 'services'));
    }
}
