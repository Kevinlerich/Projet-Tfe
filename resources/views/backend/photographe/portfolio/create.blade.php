<x-app-layout>
    <x-slot name="styles">
        <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Créer portfolio') }}
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
                <a href="{{ route('list_portfolio') }}" class="px-4 py-2 mx-4 my-3 mt-3 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">{{ __('Retour') }}</a>
                <div class="mt-5 mb-4 ml-5">
                    <form action="{{ route('store_portfolio') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">

                            <div class="sm:col-span-3">
                                <label for="service_id" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Services') }}</label>
                                <div class="mt-2">
                                    <select name="service_id" id="service_id" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        <option selected disabled>{{ __('Selectionner un service') }}</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="chemin_photo" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Gallerie') }}</label>
                                <div class="mt-2">
                                    <input type="file" name="chemin_photo[]" multiple id="chemin_photo" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>


                        </div>
                        <div class="flex items-center justify-end mt-6 gap-x-6">
                            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">{{ __('Annuler') }}</button>
                            <button type="submit" class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                {{ __('Ajouter le portfolio') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-slot name="scripts">
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/fileinput.min.js"></script>
    <script>
        $("#chemin_photo").fileinput();
    </script>
</x-slot>
