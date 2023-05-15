<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reply Message') }}
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
                <a href="{{ route('messages.index') }}" class="mt-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3 mx-4">{{ __('Back') }}</a>
                <div class="mb-4 ml-5 mt-5">
                    <form action="{{ route('reply_message', $message->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="expediteur_id" value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <input type="hidden" class="form-control" name="destinataire_id" value="{{ $message->expediteur_id }}">
                            <input type="hidden" value="{{ $message->objet }}" name="objet">
                            <input type="hidden" value="{{ $message->type }}" name="type">

                            <div class="sm:col-span-3">
                                <label for="contenue" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Content') }}</label>
                                <div class="mt-2">
                                    <textarea name="contenue" id="contenue" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </textarea>
                                </div>
                            </div>

                        </div>
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">{{ __('Cancel') }}</button>
                            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                {{ __('Send') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
