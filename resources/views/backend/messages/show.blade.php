<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Message') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <a href="{{ route('messages.index') }}" class="px-4 py-2 mx-4 my-3 mt-3 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">{{ __('Retour') }}</a>
                <div class="mt-5 mb-4 ml-5">
                    <dt>Expediteur</dt>: <b>{{ $message->expediteur->name }}</b>
                    <dt>Objet</dt> <b>{{ $message->objet }}</b>
                    <dt>Contenue</dt>: <b>{{ $message->contenue }}</b>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
