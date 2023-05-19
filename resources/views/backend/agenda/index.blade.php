<x-app-layout>
    <x-slot name="styles">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Calendrier') }}
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
                {{-- @if(auth()->user()->hasRole('client'))
                        <a href="{{ route('create_agenda') }}" class="px-4 py-2 mx-4 my-3 font-bold text-white bg-blue-500 rounded btn btn-blue hover:bg-blue-700">
                            {{ __('Ajouter un nouvel agenda') }}
                        </a>
                @endif --}}
                <div class="w-full py-5" id="calendar"></div>
                <table class="w-full py-5 table-fixed">
                    <thead>
                    <tr class="bg-gray-100">
                        @if(auth()->user()->hasRole('client'))
                            <th class="w-20 px-4 py-2">Photographe</th>
                        @else
                            <th class="w-20 px-4 py-2">Client</th>
                        @endif
                        <th class="px-4 py-2">{{ __('Début') }}</th>
                        <th class="px-4 py-2">{{ __('Fin') }}</th>
                        <th class="px-4 py-2">{{ __('Etat') }}</th>
                        <th class="px-4 py-2">{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($agendas as $key => $announce)
                        <tr>
                            @if(auth()->user()->hasRole('client'))
                                <td class="w-20 px-4 py-2 text-center">{{ $announce->photographe->name }}</td>
                            @else
                                <td class="w-20 px-4 py-2 text-center">{{ $announce->client->name }}</td>
                            @endif
                            <td class="px-4 py-2 text-center">{{ $announce->debut }}</td>
                            <td class="px-4 py-2 text-center">{{ $announce->fin }}</td>
                            <td class="px-4 py-2 text-center">{{ $announce->etat == 1 ? 'Validé' : 'En attente de confirmation' }}</td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('edit_agenda', $announce->id) }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                    {{ __('Modifier') }}
                                </a>
                                @if (Auth::user()->hasRole('photographe'))
                                    <a href="{{ route('confirmer_agenda', $announce->id) }}" class="px-4 py-2 font-bold text-white bg-yellow-300 rounded hover:bg-blue-700">
                                        {{ __('Confirmer/Annuler') }}
                                    </a>
                                @endif
                                <a class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700"  onclick="event.preventDefault();
                                                document.getElementById('del-category-{{ $announce->id }}').submit();">
                                    {{ __('Supprimer') }}
                                </a>
                                <form action="{{route('delete_agenda', $announce->id)}}" method="POST" id="del-category-{{$announce->id}}" style="display:none;">
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
