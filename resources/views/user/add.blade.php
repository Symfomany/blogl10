@extends('layout')

@section('css')
  @parent
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}" media="screen" title="no title" charset="utf-8">

@endsection

@section('content')

  <div class="col-md-12">
          <div class="box box-primary">

            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-envelope"></i> Formulaire de contact</h3>
            </div>

            <form enctype="multipart/form-data" role="form" method="post" action="">

              {{ csrf_field() }}

              <div class="box-body">


            <div class="form-group @if($errors->has('image')) has-warning  @endif">
              <label for="image">Image</label>
              <input name="image" type="file" accept="image/*" capture
               class="form-control" id="image">

              @if($errors->has('image'))
                <span class="help-block">
                  <i class="fa fa-exclamation-triangle"></i> {{ $errors->first('image') }}
                </span>
              @endif
            </div>

                <div class="form-group @if($errors->has('nom')) has-warning  @endif">
                  <label for="nom">Nom</label>
                  <input name="nom" value="{{ old('nom') }}" type="text"
                   class="form-control" id="nom"
                  placeholder="Dupond">

                  @if($errors->has('nom'))
                    <span class="help-block">
                      <i class="fa fa-exclamation-triangle"></i> {{ $errors->first('nom') }}
                    </span>
                  @endif
                </div>

                <div class="form-group @if($errors->has('prenom')) has-warning  @endif">
                  <label for="prenom">Prénom</label>
                  <input name="prenom" value="{{ old('prenom') }}" type="text"
                   class="form-control" id="prenom"
                  placeholder="Dupond">

                  @if($errors->has('nom'))
                    <span class="help-block">
                      <i class="fa fa-exclamation-triangle"></i> {{ $errors->first('prenom') }}
                    </span>
                  @endif
                </div>


                <div class="form-group @if($errors->has('email')) has-warning @endif">
                  <label for="email">Email address</label>
                  <input value="{{ old('email') }}" type="email" name="email" class="form-control" id="email" placeholder="toto@gmail.com">

                  @if($errors->has('email'))
                    <span class="help-block">
                      <i class="fa fa-exclamation-triangle"></i> {{ $errors->first('email') }}
                    </span>
                  @endif
                </div>

                <div class="form-group @if($errors->has('password')) has-warning @endif">
                  <label for="password">Mot de passe</label>
                  <input value="{{ old('password') }}" type="password" name="password" class="form-control" id="password" placeholder="toto@gmail.com">

                  @if($errors->has('password'))
                    <span class="help-block">
                      <i class="fa fa-exclamation-triangle"></i> {{ $errors->first('password') }}
                    </span>
                  @endif
                </div>

                <div class="form-group @if($errors->has('password_confirmation')) has-warning @endif">
                  <label for="password_confirmation">Confirmation de mot de passe</label>
                  <input value="{{ old('password_confirmation') }}" type="password" name="password_confirmation" class="form-control" id="password_confirmation">

                  @if($errors->has('password_confirmation'))
                    <span class="help-block">
                      <i class="fa fa-exclamation-triangle"></i>
                      {{ $errors->first('password_confirmation') }}
                    </span>
                  @endif
                </div>

                <div class="form-group @if($errors->has('phone')) has-warning @endif">
                  <label for="phone">Téléphone</label>
                  <input value="{{ old('phone') }}" type="phone" name="phone" class="form-control" id="phone" placeholder="XX-XX-XX-XX-XX">

                  @if($errors->has('phone'))
                    <span class="help-block">
                      <i class="fa fa-exclamation-triangle"></i>
                      {{ $errors->first('phone') }}
                    </span>
                  @endif
                </div>


                <div class="form-group @if($errors->has('cp')) has-warning @endif">
                  <label for="cp">Code postal</label>
                  <input value="{{ old('cp') }}" type="text" name="cp" class="form-control" id="cp" placeholder="XXXXX">

                  @if($errors->has('cp'))
                    <span class="help-block">
                      <i class="fa fa-exclamation-triangle"></i>
                      {{ $errors->first('cp') }}
                    </span>
                  @endif
                </div>


                <div class="form-group @if($errors->has('biographie')) has-warning @endif">
                  <label for="biographie">Biographie</label>
                  <textarea value="{{ old('biographie') }}" type="text" name="biographie" class="biographie form-control" id="biographie" placeholder="Blabla..."></textarea>

                  @if($errors->has('biographie'))
                    <span class="help-block">
                      <i class="fa fa-exclamation-triangle"></i>
                      {{ $errors->first('biographie') }}
                    </span>
                  @endif
                </div>


                <div class="form-group @if($errors->has('ville')) has-warning @endif">
                  <label for="ville">Ville</label>
                  <input value="{{ old('ville') }}" type="text" name="ville" class="form-control" id="ville" placeholder="ex:Lyon">

                  @if($errors->has('ville'))
                    <span class="help-block">
                      <i class="fa fa-exclamation-triangle"></i>
                      {{ $errors->first('ville') }}
                    </span>
                  @endif
                </div>

                <div class="form-group @if($errors->has('dob')) has-warning @endif">
                  <label for="dob">Date de naissance</label>
                  <input value="{{ old('dob') }}" type="text" name="dob" class="form-control" id="dob" placeholder="dd/mm/YYYY">

                  @if($errors->has('dob'))
                    <span class="help-block">
                      <i class="fa fa-exclamation-triangle"></i>
                      {{ $errors->first('dob') }}
                    </span>
                  @endif
                </div>


              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Envoyer cet email</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </div>


@endsection


@section('js')
  @parent
  <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}" charset="utf-8"></script>
  <script src="{{ asset('vendor/jquery.inputmask/dist/jquery.inputmask.bundle.js') }}"></script>

  <script>
  $(function () {
    //bootstrap WYSIHTML5 - text editor
    $(".biographie").wysihtml5();
  });
</script>

<!-- InputMask -->

  <script type="text/javascript">

      $(document).ready(function(){

        $('.alert-success').delay(10000).addClass('animated bounceOutUp');


        $('select').change(function(){
          if ($(this).val() == 'autre') {
            $('#rdv').addClass('animated fadeInUp').show();
          }else{
            $('#rdv').removeClass('animated').addClass('animated fadeInUp');
          }
        });

        $('input,textarea').focus(function(){

          if($(this).parents('.form-group').hasClass('has-warning')){

            $(this).parents('.form-group').removeClass('has-warning')
              .addClass('has-success').find('.help-block').addClass('animated fadeOutUp');
          }

        });

          var selector = $("#phone");
          var im = new Inputmask('99.99.99.99.99');
          im.mask(selector);
        });

  </script>



@endsection
