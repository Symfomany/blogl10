@extends('layout')

  @section('css')
      @parent
      <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
      <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
  @endsection

  @section('js')
      @parent
      <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
      <script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
      <script type="text/javascript">
        $('#date_activation').datepicker({ //initialisation du plugin datepicker
            autoclose: true,
            format: 'dd/mm/yyyy',
            startDate: 'd'
        });

        $(".select2").select2();
      </script>
    @endsection

  @section('content')

    <div class="col-md-6">
      <div class="box box-primary">
        <form role="form" method="post" action="">
          {{ csrf_field() }}
          <div class="box-body">


            <div class="form-group @if($errors->has('titre')) has-warning  @endif">
              <label for="titre">Titre</label>
              <input name="titre" value="{{ old('titre') }}"
               type="text" class="form-control" id="titre"
              placeholder="Titre de votre photo">

              @if($errors->has('titre'))
                <span class="help-block">
                  <i class="fa fa-exclamation-triangle"></i> {{ $errors->first('titre') }}
                </span>
              @endif

            </div>

            <div class="form-group @if($errors->has('page')) has-warning  @endif">
              <label for="page">Page</label>

              <select class="select2 form-control" name="page">
                  @foreach(\App\Page::all() as $value)
                      <option value="{{ $value->id}}">
                        {{ $value->titre}}
                      </option>
                  @endforeach
              </select>

            </div>

            <div class="form-group @if($errors->has('url')) has-warning  @endif">
              <label for="url">Url de Video</label>
              <input name="url" value="{{ old('url') }}"
               type="url" class="form-control" id="url"
              placeholder="Url de la video">

            <div class="form-group @if($errors->has('titre')) has-warning  @endif">
              <label for="titre">Titre</label>
              <input name="titre" value="{{ old('titre') }}"
               type="text" class="form-control" id="titre"
              placeholder="Titre de votre photo">

              @if($errors->has('titre'))
                <span class="help-block">
                  <i class="fa fa-exclamation-triangle"></i> {{ $errors->first('titre') }}
                </span>
              @endif

            </div>
            @if($errors->has('url'))
                <span class="help-block">
                  <i class="fa fa-exclamation-triangle"></i> {{ $errors->first('url') }}
                </span>
              @endif

            </div>

            <div class="form-group @if($errors->has('visible')) has-warning  @endif">
              <label for="oui">Oui</label>
              <input name="visible" value="1" @if(old('visible') == 1) checked @endif
               type="radio"  id="oui">

               <label for="non">Non</label>
               <input name="visible" value="0" @if(old('visible') == 0) checked @endif
                type="radio" id="non">

              @if($errors->has('visible'))
                <span class="help-block">
                  <i class="fa fa-exclamation-triangle"></i> {{ $errors->first('visible') }}
                </span>
              @endif

            </div>



            <div class="form-group @if($errors->has('date_activation')) has-warning  @endif">
              <label for="date_activation">Date d'activation</label>
              <input name="date_activation" value="{{ old('date_activation') }}"
               type="text" class="form-control" id="date_activation"
              placeholder="dd/mm/YYYY">

              @if($errors->has('date_activation'))
                <span class="help-block">
                  <i class="fa fa-exclamation-triangle"></i> {{ $errors->first('date_activation') }}
                </span>
              @endif

            </div>



          </div>
        </form>
      </div>
</div>
@endsection
