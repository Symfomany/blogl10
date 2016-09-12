@extends('layout')

@section('css')
  @parent
  <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css') }}">
@endsection

@section('content')

  <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">

            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-envelope"></i> Formulaire de contact</h3>
            </div>
            <!-- /.box-header -->

            @if(Session::has('success'))
                <div class="alert alert-success">
                  <p>{{ Session::get('success') }}</p>
                </div>
            @endif

            <form role="form" method="post" action="">

              {{ csrfmedia_field() }}

              <div class="box-body">


                <div class="form-group @if($errors->has('gender')) has-warning  @endif">
                  <input @if(old("gender") == "masculin") checked @endif name="gender"  type="radio" id="masculin" value="masculin">
                  <label for="masculin">Masculin</label>

                  <input @if(old("gender") == "feminin") checked @endif name="gender"  type="radio" id="feminin" value="feminin">
                  <label for="feminin">Féminin</label>

                  @if($errors->has('gender'))
                    <span class="help-block">
                      <i class="fa fa-exclamation-triangle"></i> {{ $errors->first('gender') }}
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

                <div class="form-group @if($errors->has('email')) has-warning @endif">
                  <label for="email">Email address</label>
                  <input value="{{ old('email') }}" type="email" name="email" class="form-control" id="email" placeholder="toto@gmail.com">

                  @if($errors->has('email'))
                    <span class="help-block">
                      <i class="fa fa-exclamation-triangle"></i> {{ $errors->first('email') }}
                    </span>
                  @endif

                </div>

                <div class="form-group @if($errors->has('site')) has-warning @endif">
                  <label for="site">Site web</label>
                  <input type="url" value="{{ old('site') }}" name="site" class="form-control" id="site" placeholder="http://www.google.fr">

                  @if($errors->has('site'))
                    <span class="help-block">
                      <i class="fa fa-exclamation-triangle"></i> {{ $errors->first('site') }}
                    </span>
                  @endif
                </div>

              <div class="form-group @if($errors->has('sujet')) has-warning @endif">
                <label for="sujet">Sujet</label>
                <select class="form-control" name="sujet" id="sujet">
                  <option @if(old('sujet') == "contact") selected @endif  value="contact">Prise de Contact</option>
                  <option @if(old('sujet') == "article") selected @endif value="article">Rédaction d'un article</option>
                  <option @if(old('sujet') == "demande") selected @endif value="demande">Demande de partenariat</option>
                  <option @if(old('sujet') == "autre") selected @endif value="autre">Autre</option>
                </select>

                @if($errors->has('sujet'))
                  <span class="help-block">
                    <i class="fa fa-exclamation-triangle"></i> {{ $errors->first('sujet') }}
                  </span>
                @endif
              </div>

            <div style="display:none" id="rdv" class="form-group @if($errors->has('site')) has-warning @endif">
              <label for="site">Date de rendez-vous</label>
              <input type="date" value="{{ old('date') }}" name="date" class="form-control" id="site" placeholder="http://www.google.fr">

              @if($errors->has('date'))
                <span class="help-block">
                  <i class="fa fa-exclamation-triangle"></i> {{ $errors->first('date') }}
                </span>
              @endif
            </div>


                <div class="form-group  @if($errors->has('message')) has-warning @endif">
                  <label for="message">Message</label>
                  <textarea name="message" class="form-control"
                   placeholder="Votre contenu nous interesse..." name="message"
                   id="message" rows="8" cols="40">{{ old('message') }}</textarea>

                   @if($errors->has('message'))
                     <span class="help-block">
                       <i class="fa fa-exclamation-triangle"></i> {{ $errors->first('message') }}
                     </span>
                   @endif
                </div>

                <div class="form-group @if($errors->has('cgu')) has-warning @endif">
                  <label>
                    <input @if(old('cgu')) checked @endif name="cgu" type="checkbox" class="flat-red"  >
                     J'accèpte les Conditions Générales d'Utilisation
                  </label>
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
      });

  </script>

@endsection
