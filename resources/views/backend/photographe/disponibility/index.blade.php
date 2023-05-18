<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Disponibilités') }}
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
                <a href="{{ route('create_disponibility') }}" class="px-4 py-2 mx-4 my-3 font-bold text-white bg-blue-500 rounded btn btn-blue hover:bg-blue-700">
                    {{ __('Ajouter une disponibilité') }}
                </a>
                <table class="w-full py-5 table-fixed">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="w-20 px-4 py-2">No</th>
                        <th class="px-4 py-2">{{ __('Début') }}</th>
                        <th class="px-4 py-2">{{ __('Fin') }}</th>
                        <th class="px-4 py-2">{{ __('Etat') }}</th>
                        <th class="px-4 py-2">{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($disponibilities as $key => $announce)
                        <tr>
                            <td class="w-20 px-4 py-2 text-center">{{ $key+1 }}</td>
                            <td class="px-4 py-2 text-center">{{ $announce->debut }}</td>
                            <td class="px-4 py-2 text-center">{{ $announce->fin }}</td>
                            <td class="px-4 py-2 text-center">{{ $announce->etat == 1 ? 'Disponible' : 'Indisponible' }}</td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('edit_disponibility', $announce->id) }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                    {{ __('Modifier') }}
                                </a>
                                <a class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700"  onclick="event.preventDefault();
                                                document.getElementById('del-category-{{ $announce->id }}').submit();">
                                    {{ __('Supprimer') }}
                                </a>
                                <form action="{{route('delete_disponibility', $announce->id)}}" method="POST" id="del-category-{{$announce->id}}" style="display:none;">
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
