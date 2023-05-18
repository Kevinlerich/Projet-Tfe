@extends('layouts.front')
@section('title')
    {{ __('Se connecter') }}
@endsection
@section('content')
<section class="py-5 login border-top-1">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8 align-item-center">
          <div class="border">
            <h3 class="p-4 bg-gray">Se connecter</h3>
            <form action="{{ route('login') }}" method="post">
                @csrf

              <fieldset class="p-4">
                <input class="mb-3 form-control" class="@error('email') is-invalid @enderror" type="text" placeholder="email" name="email" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <input class="mb-3 form-control" class="@error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="loggedin-forgot">
                  <input type="checkbox" name="remember" value="" {{ old('remember') ? 'checked' : '' }} id="keep-me-logged-in">
                  <label for="keep-me-logged-in" class="pt-3 pb-2">Se souvenir de moi</label>
                </div>
                <button type="submit" class="mt-3 btn btn-primary font-weight-bold">Log in</button>
                @if (Route::has('password.request'))
                    <a class="mt-3 d-block text-primary" href="{{ route('password.request') }}">Mot de passe oublié?</a>
                @endif
                <a class="mt-3 d-inline-block text-primary" href="{{ route('register') }}">Créer le compte</a>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
