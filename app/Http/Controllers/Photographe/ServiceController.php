<?php

namespace App\Http\Controllers\Photographe;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::query()->where('user_id', Auth::user()->id)->get();
        return view('backend.photographe.services.index', compact('services'));
    }

    public function create()
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function delete($id)
    {
        //
    }
}
