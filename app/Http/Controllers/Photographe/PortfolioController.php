<?php

namespace App\Http\Controllers\Photographe;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Portfolio;
use App\Models\Service;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
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
        $portfolio = new Portfolio();
        $service = $request->input('service_id');
        $check = Portfolio::query()->where('service_id', $service)->get();
        if ($check) {
            Toastr::success('notification', 'Ce service existe deja.');
            return back();
        } else {
            $portfolio->service_id = $request->input('service_id');
            $portfolio->user_id = Auth::user()->id;
            $portfolio->save();

            // store photos
            $photos = $request->file('chemin_photo');
            if (!Storage::disk('public')->exists('portfolios')) {
                Storage::makeDirectory('public/portfolios', 0777);
            }
            if ($photos) {
                foreach ($photos as $imagegallery) {
                    $currentDate = Carbon::now()->toDateString();
                    $gallery_name = $currentDate.'-'.uniqid().'.'.$imagegallery->getClientOriginalExtension();

                    $path = Image::make($imagegallery)->save($gallery_name, 90);
                    Storage::disk('public')->put('portfolios/'.$gallery_name, $path);
                    $photo = new Photo();
                    $photo->portfolio_id = $portfolio->id;
                    $photo->chemin_photo = $gallery_name;
                    $photo->save();
                }
            }
            Toastr::success('notification', 'Ajoute avec succes');

            return back();
        }
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
        // store photos
        $photos = $request->file('chemin_photo');
        if (!Storage::disk('public')->exists('portfolios')) {
            Storage::makeDirectory('public/portfolios', 0777);
        }
        if ($photos) {
            foreach ($photos as $imagegallery) {
                $currentDate = Carbon::now()->toDateString();
                $gallery_name = $currentDate.'-'.uniqid().'.'.$imagegallery->extension();

                $path = Image::make($imagegallery)->save($gallery_name, 90);
                Storage::disk('public')->put('portfolios/'.$gallery_name, $path);
                $photo = new Photo();
                $photo->portfolio_id = $portfolio->id;
                $photo->chemin_photo = $gallery_name;
                $photo->save();
            }
        }
        Toastr::success('notification', 'Modifie avec succes');

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
        Toastr::success('notification', 'Supprime avec succes');

        return back();
    }
}
