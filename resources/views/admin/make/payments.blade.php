@extends('layouts.app')
@section('content')
<div class="container w-50">
    <div class="summary">
        <h2 class="mb-4">Riepilogo acquisto:</h2>
        <p><strong>Sponsorizzazzione</strong>: pacchetto <span>{{$promotion->name}}</span></p>
        <p><strong>Durata</strong>: {{$promotion->duration}}gg</p>
        <p><strong>Struttura</strong>: {{$house->title}}</p>
        <p><strong>Luogo</strong>: {{$house->address}} {{$house->city}} {{$house->zip_code}}</p>
        <hr>
        <div class="text-right">
            <strong>Totale: {{$promotion->price}} &euro;</strong>
        </div>
    </div>

    <form method="POST" id="payment-form" action="{{route('admin.success', [$house->id , strtolower($promotion->name)])}}">
        
        @csrf
        @method('POST')
        
        <div class="d-flex justify-content-center align-items-center"></div>
        
        <div id="dropin"></div>
        
        <input id="nonce" name="payment_method_nonce" type="hidden"/>
        <div class="text-center">
            <a class="bnb-a bnb-btn bnb-btn-white bnb-btn-resp mt-5 mr-5" href="{{URL::previous()}}">Annulla transazione</a>
            <button class="bnb-btn bnb-btn-brand bnb-btn-resp" type="submit">Conferma acquisto</button>
        </div>
    </form>
</div>



<script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
<script>
  var form = document.querySelector('#payment-form');
  braintree.dropin.create({
    authorization: 'sandbox_tv8hnj3n_sff9x6cz2smm8qhq',
    selector: '#dropin',
  }, function (createErr, instance) {
    if (createErr) {
      console.log('Create Error', createErr);
      return;
    }
    form.addEventListener('submit', function (event) {
      event.preventDefault();
      instance.requestPaymentMethod(function (err, payload) {
        if (err) {
          console.log('Request Payment Method Error', err);
          return;
        }
        // Add the nonce to the form and submit
        document.querySelector('#nonce').value = payload.nonce;
        form.submit();
      });
    });
  });
</script>
</div>

@endsection
