<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                @if(auth()->user()->hasRole('photographe'))
                    @foreach($annonces as $annonce)
                        <div class="flex font-sans">
                            <div class="flex-none w-56 relative">
                                <img src="{{ asset('storage/'.$annonce->photo) }}" alt="" class="absolute inset-0 w-full h-full object-cover rounded-lg" loading="lazy" />
                            </div>
                            <form class="flex-auto p-6">
                                <div class="flex flex-wrap">
                                    <h1 class="flex-auto font-medium text-slate-900">
                                        {{ $annonce->titre }}
                                    </h1>
                                    <div class="text-sm font-medium text-slate-400">
                                        {{ $annonce->category->nom }}
                                    </div>
                                </div>
                                <div class="flex items-baseline mt-4 mb-6 pb-6 border-b border-slate-200">
                                    <div class="space-x-2 flex text-sm font-bold">
                                        <label>
                                            <input class="sr-only peer" name="size" type="radio" value="xs" checked />
                                            <div class="w-60 h-9 rounded-full flex items-center justify-center text-violet-400 peer-checked:bg-violet-600 peer-checked:text-white">
                                                {{ $annonce->etat_annonce == 1 ? __('Annonce validée') : 'Annonce non validée' }}
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex space-x-4 mb-5 text-sm font-medium">
                                    <div class="flex-auto flex space-x-4">
                                        <a href="{{ route('detail_annonce', $annonce->id) }}" class="h-10 px-6 font-semibold rounded-full bg-violet-600 text-white" type="submit">
                                            {{ __('Voir annonce') }}
                                        </a>
                                    </div>
                                </div>
                                <p class="text-sm text-slate-500">
                                    {!! $annonce->description !!}
                                </p>
                            </form>
                        </div>
                    @endforeach
                @else
                    @foreach($services as $service)
                        <div class="flex font-sans">
                            <div class="flex-none w-56 relative">
                                <img src="{{ asset('storage/'.$service->image_service) }}" alt="" class="absolute inset-0 w-full h-full object-cover rounded-lg" loading="lazy" />
                            </div>
                            <form class="flex-auto p-6">
                                <div class="flex flex-wrap">
                                    <h1 class="flex-auto font-medium text-slate-900">
                                        {{ $service->nom }}
                                    </h1>
                                    <div class="text-sm font-medium text-slate-400">
                                        {{ $service->category->nom }}
                                    </div>
                                </div>

                                <div class="flex space-x-4 mb-5 text-sm font-medium">
                                    <div class="flex-auto flex space-x-4">
                                        <a href="{{ route('detail_service', $service->id) }}" class="h-10 px-6 font-semibold rounded-full bg-violet-600 text-white" type="submit">
                                            {{ __('Voir service') }}
                                        </a>
                                    </div>
                                </div>
                                <p class="text-sm text-slate-500">
                                    {!! $service->description !!}
                                </p>
                            </form>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>





</x-app-layout>
