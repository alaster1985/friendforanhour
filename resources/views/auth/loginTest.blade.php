<div class="card-body">
    <h5>Войти на <span>1</span><span>-HF.com</span> </h5>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group row">
            <!-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->

            <div class="col-12">
                <input id="email" type="email" placeholder="E-mail" class="form-control @error('email') is-invalid @enderror" name="email"
                       value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->

            <div class="col-12">
                <input id="password" type="password" placeholder="Пароль"  class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        Запомнить меня
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group submit_button row mb-0">
            <div class="col-12">
                <button type="submit" class="btn btn-primary col-12">
                    Войти
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Забыли пароль? 
                    </a>
                @endif
            </div>
        </div>
    </form>
    @include('auth.social')

</div>
