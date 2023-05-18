<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $received_messages = Message::where('destinataire_id', Auth::user()->id)->get();
        $sent_messages = Message::where('expediteur_id', Auth::user()->id)->get();
        return view('backend.messages.index', compact('received_messages', 'sent_messages'));
    }

    public function reply($id)
    {
        $message = Message::query()->findOrFail($id);
        return view('backend.messages.index', compact('message'));
    }

    public function show($id)
    {
        $message = Message::query()->findOrFail($id);
        if ($message->expediteur_id != Auth::user()->id) {
            $message->status = 1;
            $message->save();
        } elseif ($message->destinataire_id == Auth::user()->id) {
            $message->status = 1;
            $message->save();
        }
        return view('backend.messages.show', compact('message'));
    }

    public function edit($id)
    {
        $message = Message::query()->findOrFail($id);
        $message->status = 1;
        $message->save();
        return view('backend.messages.reply', compact('message'));
    }

    public function store(Request $request)
    {
        Message::create([
            'expediteur_id' => Auth::user()->id,
            'destinataire_id' => $request->input('destinataire_id'),
            'objet' => $request->input('objet'),
            'contenu' => $request->input('contenue'),
            'status' => 0
        ]);
        session()->flash('session', __('Message successfully deleted'));
        return redirect()->route('messages.index');
    }

    public function create()
    {
        $livreurs = User::query()->role('photographe')->get();
        $clients = User::query()->role('client')->get();
        return view('backend.messages.create', compact('livreurs', 'clients'));
    }


    public function reply_message(Request $request, $id)
    {
        try {
            $message = Message::findOrFail($id);
            $message->expediteur_id = Auth::user()->id;
            $message->destinataire_id = $request->input('destinataire_id');
            $message->contenu = $request->input('contenue');
            $message->objet = $request->input('objet');
            $message->status = 0;
            $message->save();
            session()->flash('session', __('Message successfully updated'));
            return redirect()->route('messages.index');
        } catch (\Exception $exception) {
            return back()->withInput()->withErrors(['unexpected_error' => __('messages.unexpected_error')]);
        }
    }

    public function destroy($id)
    {
        Message::query()->findOrFail($id)->delete();
        session()->flash('message', 'Message supprimé avec succès');
        return back();
    }
}
