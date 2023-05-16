<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">

                @if(auth()->user()->hasRole('photographe'))
                    @foreach($annonces as $annonce)
                        <div class="flex font-sans">
                            <form class="flex-auto p-6">
                                <div class="flex flex-wrap">
                                    <h1 class="flex-auto font-medium text-slate-900">
                                        {{ $annonce->titre }}
                                    </h1>

                                    <div class="text-sm font-medium text-slate-400">
                                        {{ $annonce->category->nom }}
                                    </div>
                                </div>
                                <div class="flex items-baseline pb-6 mt-4 mb-6 border-b border-slate-200">
                                    <div class="flex space-x-2 text-sm font-bold">
                                        <label>
                                            <div class="flex items-center justify-center rounded-full w-60 h-9">
                                                Ajouté par: {{ $annonce->user->name }}
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex mb-5 space-x-4 text-sm font-medium">
                                    <div class="flex flex-auto space-x-4">
                                        <a href="{{ route('detail_annonce', $annonce->slug) }}" class="h-10 px-6 font-semibold text-white rounded-full bg-violet-600" type="submit">
                                            {{ __('Voir annonce') }}
                                        </a>
                                    </div>
                                </div>
                                <p class="text-sm text-slate-500">
                                    {!! Str::substr($annonce->description, 0, 50) !!}
                                </p>
                            </form>
                        </div>
                    @endforeach
                @else
                    @foreach($services as $service)
                        <div class="flex font-sans">
                            <div class="relative flex-none w-56">
                                <img src="{{ asset('storage/'.$service->image_service) }}" alt="" class="absolute inset-0 object-cover w-full h-full rounded-lg" loading="lazy" />
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

                                <div class="flex mb-5 space-x-4 text-sm font-medium">
                                    <div class="flex flex-auto space-x-4">
                                        <a href="{{ route('detail_service', $service->id) }}" class="h-10 px-6 font-semibold text-white rounded-full bg-violet-600" type="submit">
                                            {{ __('Voir service') }}
                                        </a>
                                    </div>
                                    <div class="flex flex-auto space-x-4">
                                        <a href="{{ route('detail_service', $service->id) }}" class="h-10 px-6 font-semibold" type="submit">
                                            Ajouté par: {{ $service->user->name }}
                                        </a>
                                    </div>
                                </div>
                                <p class="text-sm text-slate-500">
                                    {!! Str::substr($service->description, 0, 50) !!}
                                </p>
                            </form>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>





</x-app-layout>
