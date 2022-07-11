@extends('layouts.app')

@section('content')
 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group mb-0">
                <div class="card p-4" style="margin-bottom: 0px">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="card-body">
                        <h1>Acceder</h1>
                        <p class="text-muted">Control de acceso al sistema - CADBENI</p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input id="email" type="text" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Introducir correo electronico">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock-open"></i></span>
                                </div>
                                <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Introducir contraseña">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Iniciar') }}
                                    </button>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Recordar contraseña') }}
                                        </label>
                                    </div>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Olvidaste tu contraseña?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card text-white bg-success py-5 d-md-down-none">
                    <div class="card-body text-center">
                      <div>
                        <h2>Colegio de Arquitectos del Beni - CADBENI</h2>
                        <p>ARQUITECTURA ATRIBUCION DE ARQUITECTOS.</p>
                        <a href="https://facebook.com/cadbeni" target="_blank" class="btn btn-success active mt-3">Visitanos en FaceBoook!</a>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
