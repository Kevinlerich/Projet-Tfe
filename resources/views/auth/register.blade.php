@extends('layouts.front')

@section('title')
    {{ __('Créer un compte') }}
@endsection

@section('content')
<section class="py-5 login border-top-1">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8 align-item-center">
          <div class="border">
            <h3 class="p-4 bg-gray">Créer mon compte</h3>
            <form action="{{ route('register') }}" method="post">
                @csrf
              <fieldset class="p-4">
                <input class="mb-3 form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Email*" required>
                <input class="mb-3 form-control" type="text" name="ville" value="{{ old('ville') }}" placeholder="Ville" required>
                <input class="mb-3 form-control" type="password" placeholder="Password*" name="password" required autocomplete="new-password" required>
                <input class="mb-3 form-control" type="password" placeholder="Confirmer le mot de  passe" name="password_confirmation" autocomplete="new-password" required>
                <select class="mb-3 form-control" name="role" required>
                    <option selected disabled>Je suis </option>
                    <option value="2">photographe</option>
                    <option value="3">client</option>
                </select>
                <div class="my-3 loggedin-forgot d-inline-flex">
                  <input type="checkbox" id="registering" required class="mt-1">
                  <label for="registering" class="px-2">By registering, you accept our <a class="text-primary font-weight-bold" href="terms-condition.html">Terms & Conditions</a></label>
                </div>
                <button type="submit" class="mt-3 btn btn-primary font-weight-bold">Créer le compte</button>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
