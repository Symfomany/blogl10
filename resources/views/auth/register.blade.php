@extends('layout_logout')

@section('content')

  <div class="login-box">

    <div class="login-logo">
      <a href="../../index2.html"><b>BackOffice</b>Blog</a>
    </div>

    <div class="login-box-body">
          <p class="login-box-msg"><span class="fa fa-plus"></span> Créer un utilisateur</p>
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                        <div class="bg-info form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image">Avatar</label>
                            <input placeholder="Image" id="image" accept="image/*" capture type="file" class="form-control" name="image" value="{{ old('image') }}">

                            @if ($errors->has('image'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                                <input placeholder="Nom" id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">

                                <input placeholder="Prenom" id="prenom" type="text" class="form-control" name="prenom" value="{{ old('name') }}">

                                @if ($errors->has('prenom'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('prenom') }}</strong>
                                    </span>
                                @endif
                        </div>


                    <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">

                            <input placeholder="Ex:dd/mm/AAAA" id="dob" type="text" class="form-control" name="dob" value="{{ old('dob') }}">

                            @if ($errors->has('dob'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('dob') }}</strong>
                                </span>
                            @endif
                    </div>


                  <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">

                          <input placeholder="Ex:XX-XX-XX-XX-XX" id="phone" type="text"
                           class="form-control" name="phone" value="{{ old('phone') }}">

                          @if ($errors->has('phone'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('phone') }}</strong>
                              </span>
                          @endif
                  </div>

                  <div class="form-group{{ $errors->has('cp') ? ' has-error' : '' }}">

                      <input placeholder="Code Postal" id="cp" type="text" class="form-control" name="cp" value="{{ old('cp') }}">

                      @if ($errors->has('cp'))
                          <span class="help-block">
                              <strong>{{ $errors->first('cp') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group{{ $errors->has('ville') ? ' has-error' : '' }}">

                      <input placeholder="Ville" id="ville" type="text" class="form-control" name="ville" value="{{ old('ville') }}">

                      @if ($errors->has('ville'))
                          <span class="help-block">
                              <strong>{{ $errors->first('ville') }}</strong>
                          </span>
                      @endif
                  </div>


                  <div class="form-group{{ $errors->has('biographie') ? ' has-error' : '' }}">

                      <textarea placeholder="Votre bio...." class="form-control" name="biographie" rows="8" cols="40">
                        {{ old('biographie') }}
                      </textarea>
                      @if ($errors->has('biographie'))
                          <span class="help-block">
                              <strong>{{ $errors->first('biographie') }}</strong>
                          </span>
                      @endif
                  </div>




                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <input placeholder="Email" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                    </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                <input placeholder="Mot de passe" id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

                                <input   placeholder="Resaisissez votre mot de passe" id="password-confirm"
                                 type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Enregistrer un utilisateur
                                </button>
                            </div>
                        </div>
                    </form>
    </div>
</div>
@endsection
