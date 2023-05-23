<?php

namespace App\Http\Controllers\Photographe;

use App\Http\Controllers\Controller;
use App\Models\Disponibility;
use App\Models\RendezVous;
use App\Models\Scheduler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisponibilityController extends Controller
{
    public function index()
    {
        $disponibilities = Disponibility::query()->where('user_id', Auth::user()->id)->get();
        return view('backend.photographe.disponibility.index', compact('disponibilities'));
    }

    public function create()
    {
        return view('backend.photographe.disponibility.create');
    }

    public function store(Request $request)
    {
        $disponibility = Disponibility::query()->create([
            'user_id' => Auth::user()->id,
            'debut' => $request->input('debut'),
            'fin' => $request->input('fin'),
            'jours' => $request->input('jours'),
            'jours_end' => $request->input('jours_end'),
            'duration' => $request->input('duration'),
        ]);

        // Creation of a scheduler for the given disponibility
        $start = explode(':', $request->input('debut'));
        $fin = explode(':', $request->input('fin'));
        $duration = explode(':', $request->input('duration'));
        self::createSchedule( $disponibility);
        session()->flash('message', 'Vous avez ajouté une nouvelle disponibilité');
        return redirect()->route('my_disponibilities');
    }

    private static function createSchedule($disponibility)
    {
        try {
            $duration = explode(':', $disponibility->duration);

            $start_time = strtotime($disponibility->debut);
            $end_time = strtotime($disponibility->fin);
            $duration_sec = $duration[0] * 3600 + $duration[1] * 60;// + $duration[2];

            $time_slots = array();
            while ($start_time < $end_time) {
                $start_old = $start_time;
                $start_time += $duration_sec;
                $time_slots[] = [
                    'start' => date('H:i:s', $start_old),
                    'end' => date('H:i:s', $start_time),
                    'disponibility_id' => $disponibility->id,
                ];
            }

            Scheduler::query()->upsert($time_slots, []);
        } catch(\Exception $e) {
            throw new \Exception("Error :". $e->getMessage());
        }
    }

    public function edit($id)
    {
        $disponibility = Disponibility::query()->findOrFail($id);
        return view('backend.photographe.disponibility.edit', compact('disponibility'));
    }

    public function update(Request $request, $id)
    {
        $disponibility = Disponibility::query()->where('id', $id)->update([
            'user_id' => Auth::user()->id,
            'debut' => $request->input('debut'),
            'fin' => $request->input('fin'),
            'jours' => $request->input('jours'),
            'jours_end' => $request->input('jours_end'),
            'duration' => $request->input('duration'),
        ]);
        self::createSchedule($disponibility);
        session()->flash('message', 'Vous avez ajouté une nouvelle disponibilité');
        return redirect()->route('my_disponibilities');
    }

    /**
     * return available schedule for a given date
     * @param Request $request
     * @return JsonResponse
     */
    public function getScheduler(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'date' => ['required'],
            'photographe_id' => ['required'],
        ]);

        $appointments = RendezVous::query()
            ->whereDate('date_appointment', $validated['date'])
            ->where('photographe_id',$validated['photographe_id'])
            ->pluck('scheduler_id');

        // get availability of the personnel on the given day
        $day = date('l', strtotime($validated['date']));
        $day = (new RendezVous())->days[$day];

        $availability = RendezVous::query()
            ->where('day', $day)
            ->wherePhotographeId($validated['personnel_id'])
            ->first();

        $query = Scheduler::query()->where('disponibility_id', $availability->id);

        if ($appointments->count() === 0) {
            $data = $query->get();
        } else {
            $data = $query->whereNotIn('id', $appointments)
                ->get();
        }

        if ($validated['date'] == now()->format('Y-m-d')) {
            $hn = now()->format('H');
            $return = [];
            foreach ($data as $d) {
                $h = explode(':', $d->start)[0];
                if ($h > $hn) {
                    $return[] = $d;
                }
            }
            return response()->json($return);
        } else {
            return response()->json($data);
        }
    }

    public function delete($id)
    {
        Disponibility::query()->findOrFail($id)->delete();
        session()->flash('message', 'Disponibilité supprimée avec succès !!!');
        return back();
    }
}
