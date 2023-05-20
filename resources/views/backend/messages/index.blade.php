<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                @if (session()->has('message'))
                    <div class="px-4 py-3 my-3 text-teal-900 bg-teal-100 border-t-4 border-teal-500 rounded-b shadow-md" role="alert">
                        <div class="flex">
                            <div>
                                <p class="text-sm">{{ session('message') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                <p class="px-4 py-2 mx-4 my-3 font-bold text-white bg-blue-500 rounded btn btn-blue hover:bg-blue-700">
                    {{ __('Messages reçus') }}
                </p>
                <table class="w-full py-5 table-fixed">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="w-20 px-4 py-2">No</th>
                        <th class="px-4 py-2">{{ __('Expediteur') }}</th>
                        <th class="px-4 py-2">{{ __('Contenu') }}</th>
                        <th class="px-4 py-2">{{ __('Object') }}</th>
                        <th class="px-4 py-2">{{ __('Date') }}</th>
                        <th class="px-4 py-2">{{ __('Statut') }}</th>
                        <th class="px-4 py-2">{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($received_messages as $key => $message)
                        <tr>
                            <td class="w-20 px-4 py-2 text-center">{{ $key+1 }}</td>
                            <td class="px-4 py-2 text-center">{{ $message->expediteur->email }}</td>
                            <td class="px-4 py-2 text-center">{{ Str::substr($message->contenue, 0, 10) }}</td>
                            <td class="px-4 py-2 text-center">{{ $message->objet }}</td>
                            <td class="px-4 py-2 text-center">{{ $message->created_at->diffForHumans() }}</td>
                            <td class="px-4 py-2 text-center">
                                @if($message->status == 1)
                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                        Lu
                                    </span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
                                        Non lu
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('messages.edit', $message->id) }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                    {{ __('Répondre') }}
                                </a>

                                <a href="{{ route('messages.show', $message->id) }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                    {{ __('Voir') }}
                                </a>
                                <a class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700"  onclick="event.preventDefault();
                                document.getElementById('del-message-{{ $message->id }}').submit();">
                                    {{ __('Supprimer') }}
                                </a>
                                <form action="{{route('messages.destroy', $message->id)}}" method="POST" id="del-message-{{$message->id}}" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                @if (session()->has('message'))
                    <div class="px-4 py-3 my-3 text-teal-900 bg-teal-100 border-t-4 border-teal-500 rounded-b shadow-md" role="alert">
                        <div class="flex">
                            <div>
                                <p class="text-sm">{{ session('message') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                <p class="px-4 py-2 mx-4 my-3 font-bold text-white bg-blue-500 rounded btn btn-blue hover:bg-blue-700">
                    {{ __('Messages envoyés') }}
                </p>
                <a href="{{ route('messages.create') }}" class="px-4 py-2 mx-4 my-3 font-bold text-white bg-blue-500 rounded btn btn-blue hover:bg-blue-700">
                    {{ __('Ecrire message') }}
                </a>
                <table class="w-full py-5 table-fixed">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="w-20 px-4 py-2">No</th>
                        <th class="px-4 py-2">{{ __('Destinataire') }}</th>
                        <th class="px-4 py-2">{{ __('Content') }}</th>
                        <th class="px-4 py-2">{{ __('Object') }}</th>
                        <th class="px-4 py-2">{{ __('Date') }}</th>
                        <th class="px-4 py-2">{{ __('Status') }}</th>
                        <th class="px-4 py-2">{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sent_messages as $key => $sms)
                        <tr>
                            <td class="w-20 px-4 py-2 text-center">{{ $key+1 }}</td>
                            <td class="px-4 py-2 text-center">{{ $sms->destinataire->email }}</td>
                            <td class="px-4 py-2 text-center">{{ Str::substr($sms->contenu, 0, 10) }}</td>
                            <td class="px-4 py-2 text-center">{{ $sms->objet }}</td>
                            <td class="px-4 py-2 text-center">{{ $sms->created_at->diffForHumans() }}</td>
                            <td class="px-4 py-2 text-center">
                                @if($sms->status == 1)
                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                        Lu
                                    </span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
                                        Non lu
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('messages.show', $sms->id) }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                    {{ __('Voir') }}
                                </a>
                                <a class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700"  onclick="event.preventDefault();
                                document.getElementById('del-message-{{ $sms->id }}').submit();">
                                    {{ __('Supprimer') }}
                                </a>
                                <form action="{{route('messages.destroy', $sms->id)}}" method="POST" id="del-message-{{$sms->id}}" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
