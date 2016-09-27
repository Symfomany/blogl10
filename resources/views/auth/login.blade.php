@extends('layout_logout')

@section('content')

  <div class="login-box">

    <div class="login-logo">
      <a href="../../index2.html"><b>BackOffice</b>Blog</a>
    </div>

    <div class="login-box-body">

      <p class="login-box-msg">Connexion au Dashboard</p>

        <form role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}

            <div class="form-group has-feedback {{ $errors->has('email') ? '  has-error' : '' }}">

                    <input id="email" type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('password') ? '  has-error' : '' }}">

                    <input id="password" placeholder="Password" type="password" class="form-control" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
            </div>


            <div class="row">
              <div class="col-xs-8">
                <div class="checkbox icheck">
                  <label class="">

                    <input type="checkbox" name="remember"> Remember Me
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
              </div>
              <!-- /.col -->
            </div>


            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-sign-in"></i> Login
                    </button>

                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                </div>
            </div>

        </form>

        {{-- <div class="social-auth-links text-center">
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
            Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
            Google+</a>
        </div> --}}

        <div class="row">

        <a href="{{ url('/register')}}" class="btn btn-success btn-sm">
          <span class="fa fa-plus"></span> Créer un utilisateur</a>

        </div>

</div>
</div>
@endsection
