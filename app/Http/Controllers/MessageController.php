<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::query()->where('destinataire_id', Auth::user()->id)->get();
        return view('backend.messages.index', compact('messages'));
    }

    public function reply($id)
    {
        $message = Message::query()->findOrFail($id);
        return view('backend.messages.index', compact('message'));
    }

    public function store(Request $request)
    {
        $message = Message::query()->findOrFail($request->input('message_id'));
        Message::query()->create([
            'expediteur_id' => Auth::user()->id,
            'destinataire_id' => $message->expediteur_id,
            'objet' => $message->input('objet'),
            'contenu' => $message->input('message'),
        ]);
        session()->flash('message', 'Votre message a été envoyé');
        return redirect()->route('my_messages');
    }

    public function delete($id)
    {
        Message::query()->findOrFail($id)->delete();
        session()->flash('message', 'Message supprimé avec succès');
        return back();
    }
}
