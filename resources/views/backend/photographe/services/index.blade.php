<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if (session()->has('message'))
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                        <div class="flex">
                            <div>
                                <p class="text-sm">{{ session('message') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                <a href="{{ route('create_service') }}" class="btn btn-blue bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3 mx-4">
                    {{ __('Ajouter un service') }}
                </a>
                <table class="table-fixed w-full py-5">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No</th>
                        <th class="px-4 py-2">{{ __('Titre') }}</th>
                        <th class="px-4 py-2">{{ __('Description') }}</th>
                        <th class="px-4 py-2">{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($services as $key => $service)
                        <tr>
                            <td class="px-4 py-2 w-20 text-center">{{ $key+1 }}</td>
                            <td class="px-4 py-2 text-center">{{ $service->nom }}</td>
                            <td class="px-4 py-2 text-center">{{ $service->description }}</td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('edit_service', $service->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    {{ __('Modifier') }}
                                </a>
                                <a class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"  onclick="event.preventDefault();
                                                document.getElementById('del-category-{{ $service->id }}').submit();">
                                    {{ __('Supprimer') }}
                                </a>
                                <form action="{{route('delete_service', $service->id)}}" method="POST" id="del-category-{{$service->id}}" style="display:none;">
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
