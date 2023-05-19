<?php

namespace App\Http\Controllers\Photographe;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::query()->where('user_id', Auth::user()->id)->get();
        return view('backend.photographe.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        $services = Service::query()->where('user_id', Auth::user()->id)->get();
        return view('backend.photographe.portfolio.create', compact('services'));
    }

    public function store(Request $request)
    {
        $portfolio = Portfolio::query()->create([
            'service_id' => $request->input('service_id'),
            'user_id' => Auth::user()->id
        ]);

        // store photos
        $photos = $request->file('chemin_photo');
        if (!Storage::disk('public')->exists('portfolios')) {
            Storage::makeDirectory('public/portfolios', 0777);
        }
        if ($photos) {
            foreach ($photos as $photo) {
                $path = 'portfolios/' . uniqid() . '.' . $photo->extension();
                Image::make($request->file('chemin_photo'))->resize(750, 500)->save(public_path() . "/storage/" .$path, 90);
                Photo::query()->create([
                    'portfolio_id' => $portfolio->id,
                    'chemin_photo' => $path
                ]);
            }
        }

        return back();
    }

    public function edit($id)
    {
        $portfolio = Portfolio::query()->findOrFail($id);
        $services = Service::query()->where('user_id', Auth::user()->id)->get();
        return view('backend.photographe.portfolio.edit', compact('portfolio', 'services'));
    }

    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::query()->findOrFail($id);
        $portfolio->service_id = $request->input('service_id');
        $portfolio->save();
        return redirect()->route('list_portfolio');
    }

    public function show($id)
    {
        $portfolio = Portfolio::query()->findOrFail($id);
        $services = Service::query()->where('user_id', Auth::user()->id)->get();
        return view('backend.photographe.portfolio.show', compact('portfolio', 'services'));
    }

    public function delete($id)
    {
        $portfolio = Portfolio::query()->findOrFail($id);
        $portfolio->delete();
        return back();
    }
}
