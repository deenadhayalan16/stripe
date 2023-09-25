@extends("main")
@section("content")
<div class="container">

    <div class="row bg bg-warning mt-5 mb-5">
        <div class="col-md-6 col-md-offset-3 mt-5">
            <div class="panel panel-default credit-card-box">
                <h4 class="panel-title text-left">Product Details</h4>
                <div>

                    <p class="p-1"><strong>Product Name : </strong>{{$productdetails->name}}</p>
                    <p class="p-1"><strong>Product Price : </strong>{{$productdetails->price}}</p>
                    <p class="p-1"><strong>Product Description : </strong>{{$productdetails->description}}</p>
                    <p class="p-1"><strong>Qty : </strong><input type="number" name="product_qty" id="product_qty" value="1" class="productqty" data-price="{{$productdetails->price}}"></p>

                </div>
            </div>
        </div>
        <div class="col-md-6 col-md-offset-3 mt-5">
            <div class="panel panel-default credit-card-box">
                <h4 class="panel-title text-left">Payment Details</h4>
                <form 
                            role="form" 
                            action="{{ route('stripe') }}" 
                            method="post" 
                            class="require-validation"
                            data-cc-on-file="false"
                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="payment-form">
                        @csrf
    
                        <div class='form-row row'>
                            <div class='col-md-12 form-group required'>
                                <label class='control-label'>Name on Card</label> 
                                <input class='form-control'  type='text'>
                            </div>
                        </div>
    
                        <div class='form-row row'>
                            <div class='col-md-12 form-group required'>
                                <label class='control-label'>Card Number</label> 
                                <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                            </div>
                        </div>
    
                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label> 
                                <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> 
                                <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                            </div>
                            <input class='form-control product-price' placeholder='Price' type='hidden' name="price">
                        </div>
    
                        <div class='form-row row mt-1'>
                            <div class='col-md-12 error form-group hide'>
                                <div class='alert-danger alert'>Please fill all the fields</div>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now <span class="p_price"></span></button>
                            </div>
                        </div>
                            
                    </form>
            </div>
        </div>
    </div>
   
</div>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    
<script type="text/javascript">
  
$(function() {
  
    /*------------------------------------------
    --------------------------------------------
    Stripe Payment Code
    --------------------------------------------
    --------------------------------------------*/
    
    var $form = $(".require-validation");
     
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('hide');
    
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });
     
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val(),
            
          }, stripeResponseHandler);
        }
    
    });
      
    /*------------------------------------------
    --------------------------------------------
    Stripe Response Handler
    --------------------------------------------
    --------------------------------------------*/
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
                 
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
     
});
</script>
@endsection