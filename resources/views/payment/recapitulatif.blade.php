@extends('layout')

@section('js')
  @parent
  {{-- Stripe recommande Jquery pour l'utilisation  --}}
  {{-- API(ensemble de fonctions) en JS de Stripe --}}
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>



  <script type="text/javascript">
    // demarre de Jquery
    $(function(){

      // connection à notre Compte par la clef primaire (identifiant)
      Stripe.setPublishableKey('pk_test_jWuVIvzJdP8hwP1jnLEgYDLT');

      $form =  $('#payment-form');
      // submit : quand je soumet mon formulaire
      $form.submit(function(event) {

        // Disable the submit button to prevent repeated clicks:
        $(this).find('#send').attr('disabled');

        // Request a token from Stripe:
        Stripe.card.createToken({
           number: $('.card-number').val(),
           cvc: $('.card-cvc').val(),
           exp_month: $('.card-expiry-month').val(),
           exp_year: $('.card-expiry-year').val()
         }, function (status, response) {
           if (response.error) { // Ah une erreur !
             // On affiche les erreurs
             $form.find('.payment-errors').text(response.error.message);
             $form.find('button').prop('disabled', false); // On réactive le bouton
           } else { // Le token a bien été créé
             var token = response.id; // On récupère le token
             // On crée un champs cachée qui contiendra notre token
             $form.append($('<input type="hidden" name="stripeToken" />').val(token));
             $form.get(0).submit(); // On soumet le formulaire
           }
         });

        // Prevent the form from being submitted:
        return false;
      });
  });
  </script>

@endsection


@section('content')

  @if(Session::has('success'))
      <div class="alert alert-success">
          {{ Session::get('success') }}
      </div>
  @endif
  
  <section class="invoice">

      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> AdminLTE, Inc.
            <small class="pull-right">Date: <i>{{ Carbon\Carbon::now()->format('d/m/Y') }}</i></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>Plateforme de Blog</strong><br>
            3WA Academy<br>
            69100 Villeurbanne<br>
            Email: julien@meetserious.com
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong>{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</strong><br>
            {{ Auth::user()->phone }}<br>
            {{ Auth::user()->cp }} {{ Auth::user()->ville }}<br>
            Email: <a>{{ Auth::user()->email }}</a>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #007612</b><br>
          <br>
          <b>Order ID:</b> 4F3S8J<br>
          <b>Payment Due:</b> {{ Carbon\Carbon::now() }}<br>
          <b>Account:</b> {{ Auth::user()->id }}
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Id</th>
              <th>Image</th>
              <th>Titre #</th>
              <th>Description</th>
              <th>Prix</th>
            </tr>
            </thead>
            <tbody>
              @foreach(session('likes', []) as $key => $value)
                <tr>
                  <td>{{ $key }}</td>
                  <td><img src="{{ App\Article::find($key)->image }}"
                     alt="" class="thumbnail img-responsive" /></td>
                  <td>{{ $value }}</td>
                  <td>{{ App\Article::find($key)->description }}</td>
                  <td><strong>{{ App\Article::find($key)->price }}€</strong></td>
                </tr>
              @endforeach

            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <hr class="clear clearfix" />
      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Payment Methods:</p>
          <img src="../../dist/img/credit/visa.png" alt="Visa">
          <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="../../dist/img/credit/american-express.png" alt="American Express">
          <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

      <form action="" method="post" id="payment-form">

            {{ csrf_field() }}

            <span class="text-danger payment-errors"></span>

            <div class="form-row">
              <label>
                <span>Numéro de carte</span>
                <input class="col-md-6 form-control card-number" required type="text"
                 size="20" data-stripe="number">
              </label>
            </div>

            <div class="form-row">
              <label>
                <span>Date Expiration (MM/YY)</span>
                <input class="card-expiry-month col-md-2 form-control"
                required type="text" size="2" data-stripe="exp_month">
              <span> / </span>
              <input type="text" class="card-expiry-year col-md-2 form-control"
               required size="2" data-stripe="exp_year">
            </label>
            </div>

            <div class="form-row">
              <label>
                <span>Cryptogramme Visuel</span>
                <input class="card-cvc form-control"
                required type="text" size="4" data-stripe="cvc">
              </label>
            </div>

            {{-- <input type="hidden" name="amount" value="{{ $somme + $somme * 0.2 }}"> --}}

            <button type="submit" id="send" class="btn btn-info">
              <span class="fa fa-credit-card"></span> Payer cette somme
            </button>

      </form>
    </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount Due <b>{{ Carbon\Carbon::parse("+2week")->format('d/m/Y')}} </b></p>

          <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th style="width:50%">Subtotal:</th>
                <td>{{ $somme}}€</td>
              </tr>
              <tr>
                <th>Taxe TVA (20%)</th>
                <td>{{ $somme*0.2 }}</td>
              </tr>
              <tr>
                <th><h3>Total TTC</h3></th>
                <td><h3>{{ $somme + $somme*0.2 }}€</h3></td>
              </tr>
            </tbody></table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>
        </div>
      </div>
    </section>



@endsection
