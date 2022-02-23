@extends('frontend.layouts.master')

@section('title','Checkout page')

@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">Checkout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
            
    <!-- Start Checkout -->
    <section class="shop checkout section">
        <div class="container">
            <form class="form" method="POST" action="{{route('cart.order')}}" id="payment-form">
                @csrf
                <div class="row"> 
                    <div class="col-lg-8 col-12">
                        <div class="checkout-form">
                            <h2>Make Your Checkout Here</h2>
                            <p>Please register in order to checkout more quickly</p>
                            <!-- Form -->
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>First Name<span>*</span></label>
                                        <input type="text" name="first_name" placeholder="" value="{{old('first_name')}}" value="{{old('first_name')}}">
                                        @error('first_name')
                                            <span class='text-danger'>{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Last Name<span>*</span></label>
                                        <input type="text" name="last_name" placeholder="" value="{{old('lat_name')}}">
                                        @error('last_name')
                                            <span class='text-danger'>{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Email Address<span>*</span></label>
                                        <input type="email" name="email" placeholder="" value="{{old('email')}}">
                                        @error('email')
                                            <span class='text-danger'>{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Phone Number <span>*</span></label>
                                        <input type="number" name="phone" placeholder="" required value="{{old('phone')}}">
                                        @error('phone')
                                            <span class='text-danger'>{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group state">
                                        <label>State<span>*</span></label>
                                        <select class="state-select2" name="state">
                                            <option value="" disabled selected>Select state</option>
                                            @foreach(config('const.states') as $key => $state)
                                                <option value="{{ $key }}">{{ $state }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group city">
                                        <label>City<span>*</span></label>
                                        <select class="city-select2" name="city">
                                            <option value="" disabled selected>Select city</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Address Line 1<span>*</span></label>
                                        <input type="text" name="address1" placeholder="" value="{{old('address1')}}">
                                        @error('address1')
                                            <span class='text-danger'>{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Address Line 2</label>
                                        <input type="text" name="address2" placeholder="" value="{{old('address2')}}">
                                        @error('address2')
                                            <span class='text-danger'>{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Postal Code</label>
                                        <input type="text" name="post_code" placeholder="" value="{{old('post_code')}}">
                                        @error('post_code')
                                            <span class='text-danger'>{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                            </div>
                            <!--/ End Form -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="order-details">
                            <!-- Order Widget -->
                            <div class="single-widget">
                                <h2>CART  TOTALS</h2>
                                <div class="content">
                                    <ul>
                                        <li class="order_subtotal" data-price="{{Helper::totalCartPrice()}}">Cart Subtotal<span>{{number_format(Helper::totalCartPrice(),2)}} MMK</span></li>
                                        <li class="shipping">
                                            Shipping Cost
                                            @if(count(Helper::shipping())>0 && Helper::cartCount()>0)
                                                <select name="shipping" class="shipping-select">
                                                    <option value="">Select your address</option>
                                                    @foreach(Helper::shipping() as $shipping)
                                                    <option value="{{$shipping->id}}" class="shippingOption" data-price="{{$shipping->price}}">{{$shipping->type}}: {{$shipping->price}} MMK</option>
                                                    @endforeach
                                                </select>
                                            @else 
                                                <span>Free</span>
                                            @endif
                                        </li>
                                        
                                        @if(session('coupon'))
                                        <li class="coupon_price" data-price="{{session('coupon')['value']}}">You Save<span>{{number_format(session('coupon')['value'],2)}} MMK</span></li>
                                        @endif
                                        @php
                                            $total_amount=Helper::totalCartPrice();
                                            if(session('coupon')){
                                                $total_amount=$total_amount-session('coupon')['value'];
                                            }
                                        @endphp
                                        @if(session('coupon'))
                                            <li class="last"  id="order_total_price">Total<span>{{number_format($total_amount,2)}} MMK</span></li>
                                        @else
                                            <li class="last"  id="order_total_price">Total<span>{{number_format($total_amount,2)}} MMK</span></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <!--/ End Order Widget -->
                            <!-- Order Widget -->
                            <div class="single-widget">
                                <h2>Payments</h2>
                                <div class="content">
                                    <div class="checkbox">
                                        <div class="form-check form-switch">
                                            <input type="radio" name="payment_method" value="cash" id="cash" class="form-check-input" role="switch">
                                            <label class="form-check-label" for="cash">Cash</label>
                                        </div>
                                        <div id="cashCollapse" class="collapse mb-3">
                                            <h2 class="px-0">PAY BY CASH</h2>
                                            <p>Consider payment upon ordering for contactless delivery. You can't pay by a card to the rider upon delivery.</p>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input type="radio" name="payment_method" value="credit" id="credit" class="form-check-input" role="switch">
                                            <label class="form-check-label" for="credit">Card / Stripe</label>
                                        </div>
                                        <div id="creditCollapse" class="collapse mt-3">
                                            @php
                                                $stripe_key = config('const.stripe_key');
                                            @endphp
                                            <div class="form-group">
                                                <div id="card-element"></div>
                                                <div id="card-errors" role="alert"></div>
                                                <input type="hidden" name="plan" value="" />
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <!--/ End Order Widget -->
                            <!-- Payment Method Widget -->
                            <div class="single-widget payement">
                                <div class="content">
                                    <img src="{{('backend/img/payment-method.png')}}" alt="#">
                                </div>
                            </div>
                            <!--/ End Payment Method Widget -->
                            <!-- Button Widget -->
                            <div class="single-widget get-button">
                                <div class="content">
                                    <div class="button">
                                        <button type="submit" class="btn">proceed to checkout</button>
                                    </div>
                                </div>
                            </div>
                            <!--/ End Button Widget -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!--/ End Checkout -->
@endsection
@push('styles')
	<style>
		li.shipping{
			display: inline-flex;
			width: 100%;
			font-size: 14px;
		}
		li.shipping .input-group-icon {
			width: 100%;
			margin-left: 10px;
		}
		.input-group-icon .icon {
			position: absolute;
			left: 20px;
			top: 0;
			line-height: 40px;
			z-index: 3;
		}
		.form-select {
			height: 30px;
			width: 100%;
		}
		.list li{
			margin-bottom:0 !important;
		}
		.list li:hover{
			background:#fa314a !important;
			color:white !important;
		}
	</style>
@endpush
@push('scripts')
    <script>
        // toggle payment
        $('[name="payment_method"]').on('change', function(){  
            // cash
            if($(this).val()  === "cash"){
                $('#cashCollapse').collapse('show')
            }else{
                $('#cashCollapse').collapse('hide')
            }
            // credit
            if($(this).val()  === "credit"){
                $('#creditCollapse').collapse('show')
            }else{
                $('#creditCollapse').collapse('hide')
            }
        });
    </script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ $stripe_key }}');
        var elements = stripe.elements();
         // Custom styling can be passed to options when creating an Element.
        var style = {
            base: {
                // Add your base input styles here. For example:
                fontSize: '16px',
                color: "#32325d",
                border: '2px solid red',
            }
          
        };
        // Create an instance of the card Element
        var card = elements.create('card', {style: style});
        // Add an instance of the card Element into the `card-element` <div>
        card.mount('#card-element');
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
       });
       
        //step 3
       // Create a token or display an error when the form is submitted.
       $('.form-check-input').change(function(){
            if($(this).val() == 'credit')
            {
                var form = document.getElementById('payment-form');
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    stripe.createToken(card).then(function(result) {
                        if (result.error) {
                        // Inform the customer that there was an error
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                        } else {
                        // Send the token to your server
                        stripeTokenHandler(result.token);
                        }
                    });
                });
            }
        });

        //step 4
        function stripeTokenHandler(token) {
            //console.log(token); 
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            // Submit the form
            form.submit();
        } 
    </script>
	<script>
        // city and state select option
		$(document).ready(function(){
			$('.shipping select[name=shipping]').change(function(){
				let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
				let subtotal = parseFloat( $('.order_subtotal').data('price') ); 
				let coupon = parseFloat( $('.coupon_price').data('price') ) || 0; 
				// alert(coupon);
				$('#order_total_price span').text('$'+(subtotal + cost-coupon).toFixed(2));
			});
            
            $('.state select[name=state]').change(function () {
                let val = $(this).val();
                if (val == "ayeyarwady") {
                    $('.city select[name=city]').html("@foreach(config('const.ayeyarwady') as $key => $value)<option value='{{ $key }}'>{{ $value }}</option>@endforeach");
                } else if (val == "bago") {
                    $('.city select[name=city]').html("@foreach(config('const.bago') as $key => $value)<option value='{{ $key }}'>{{ $value }}</option>@endforeach");
                } else if (val == "chin") {
                    $('.city select[name=city]').html("@foreach(config('const.chin') as $key => $value)<option value='{{ $key }}'>{{ $value }}</option>@endforeach");
                } else if (val == "kachin") {
                    $('.city select[name=city]').html("@foreach(config('const.kachin') as $key => $value)<option value='{{ $key }}'>{{ $value }}</option>@endforeach");
                } else if (val == "kayah") {
                    $('.city select[name=city]').html("@foreach(config('const.kayah') as $key => $value)<option value='{{ $key }}'>{{ $value }}</option>@endforeach");
                } else if (val == "kayin") {
                    $('.city select[name=city]').html("@foreach(config('const.kayin') as $key => $value)<option value='{{ $key }}'>{{ $value }}</option>@endforeach");
                } else if (val == "magway") {
                    $('.city select[name=city]').html("@foreach(config('const.magway') as $key => $value)<option value='{{ $key }}'>{{ $value }}</option>@endforeach");
                } else if (val == "mandalay") {
                    $('.city select[name=city]').html("@foreach(config('const.mandalay') as $key => $value)<option value='{{ $key }}'>{{ $value }}</option>@endforeach");
                } else if (val == "mon") {
                    $('.city select[name=city]').html("@foreach(config('const.mon') as $key => $value)<option value='{{ $key }}'>{{ $value }}</option>@endforeach");
                } else if (val == "naypyitaw") {
                    $('.city select[name=city]').html("@foreach(config('const.naypyitaw') as $key => $value)<option value='{{ $key }}'>{{ $value }}</option>@endforeach");
                } else if (val == "rakhine") {
                    $('.city select[name=city]').html("@foreach(config('const.rakhine') as $key => $value)<option value='{{ $key }}'>{{ $value }}</option>@endforeach");
                } else if (val == "sagaing") {
                    $('.city select[name=city]').html("@foreach(config('const.sagaing') as $key => $value)<option value='{{ $key }}'>{{ $value }}</option>@endforeach");
                } else if (val == "shan") {
                    $('.city select[name=city]').html("@foreach(config('const.shan') as $key => $value)<option value='{{ $key }}'>{{ $value }}</option>@endforeach");
                } else if (val == "tanintharyi") {
                    $('.city select[name=city]').html("@foreach(config('const.tanintharyi') as $key => $value)<option value='{{ $key }}'>{{ $value }}</option>@endforeach");
                } else if (val == "yangon") {
                    $('.city select[name=city]').html("@foreach(config('const.yangon') as $key => $value)<option value='{{ $key }}'>{{ $value }}</option>@endforeach");
                } 
            });

		});
	</script>
@endpush