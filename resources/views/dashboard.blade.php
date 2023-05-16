<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            {{-- <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">

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
            </div> --}}
            <div class="py-24 bg-white sm:py-32">
                @if (Auth::user()->hasRole('client'))
                <div class="grid px-6 mx-auto max-w-7xl gap-x-8 gap-y-20 lg:px-8 xl:grid-cols-3">
                    <div class="max-w-2xl">
                      <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Les annonces de la plateforme</h2>
                    </div>
                    <ul role="list" class="grid gap-x-8 gap-y-12 sm:grid-cols-2 sm:gap-y-16 xl:col-span-2">
                      @foreach($annonces as $annonce)
                        <li>
                        <div class="flex items-center gap-x-6">
                          <div>
                            <h3 class="text-base font-semibold leading-7 tracking-tight text-gray-900">
                                <a href="{{ route('detail_annonce', $annonce->slug) }}">{{ $annonce->titre }}</a>
                            </h3>
                            <p class="text-sm font-semibold leading-6 text-gray-600">{!! ($annonce->description) !!}</p>
                            <p class="text-sm font-semibold leading-6 text-indigo-600">Par: {{ $annonce->user->name }} {{ $annonce->created_at->diffForHumans() }}</p>
                          </div>
                        </div>
                      </li>
                      @endforeach
                    </ul>
                  </div>
                @else
                <div class="grid px-6 mx-auto max-w-7xl gap-x-8 gap-y-20 lg:px-8 xl:grid-cols-3">
                    <div class="max-w-2xl">
                      <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Les services</h2>
                      <p class="mt-6 text-lg leading-8 text-gray-600">Services des photographes présents dans la plateforme</p>
                    </div>
                    <ul role="list" class="grid gap-x-8 gap-y-12 sm:grid-cols-2 sm:gap-y-16 xl:col-span-2">
                      @foreach ($services as $service)
                      <li>
                        <div class="flex items-center gap-x-6">
                          <img class="w-16 h-16 rounded-full" src="{{ asset('storage/'.$service->image_service) }}" alt="">
                          <div>
                            <h3 class="text-base font-semibold leading-7 tracking-tight text-gray-900">
                                <a href="{{ route('detail_service',$service->id) }}">{{ $service->nom }}</a>
                            </h3>
                            <p class="text-sm font-semibold leading-6 text-indigo-600">{{ Str::substr($service->description, 0, 10) }}</p>
                          </div>
                        </div>
                      </li>
                      @endforeach
                    </ul>
                  </div>
                @endif

            </div>
        </div>
    </div>





</x-app-layout>
