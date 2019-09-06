@extends('EndoCore::admin.layout.html')

@section('body')
    <div class="middle-box text-center animated fadeInDown">
        <div class="col-md-12" >
            <div>
                <h1 class="logo-name">Endo 4</h1>
            </div>
            <h3>{{ env('APP_NAME') }}</h3>

            <p>@lang('Login')</p>
            <form class="m-t" role="form" method="POST" action="{{ route('login') }}" aria-label="@lang('Login')">
                @csrf
                <div class="form-group">
                    <input id="email" type="email" placeholder="@lang('Email')" class="form-control" name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control" name="password" placeholder="@lang('Password')" required>
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox" name="remember"> @lang('Remember Me')
                    </label>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">@lang('Login')</button>

                <a href="{{ route('password.request') }}"><small>@lang('Forgot Your Password?')</small></a>
            </form>
            <p class="m-t"><small>Copyright 6tems &copy; <?php echo date("Y"); ?></small> </p>
        </div>
    </div>
@endsection
