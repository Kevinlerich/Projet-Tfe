<?php

namespace App\Http\Controllers\Photographe;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
        $categories = Category::query()->get();
        return view('backend.photographe.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        Service::query()->create([
            'user_id' => Auth::user()->id,
            'nom' => $request->input('nom'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id')
        ]);
        return redirect()->route('list_service');
    }

    public function edit($id)
    {
        $service = Service::query()->findOrFail($id);
        $categories = Category::query()->get();
        return view('backend.photographe.services.edit', compact('categories', 'service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::query()->findOrFail($id);
        $service->category_id = $request->input('category_id');
        $service->nom = $request->input('nom');
        $service->description = $request->input('description');
        $service->save();
        return redirect()->route('list_service');
    }

    public function delete($id)
    {
        $service = Service::query()->findOrFail($id);
        $service->delete();
        return back();
    }
}
