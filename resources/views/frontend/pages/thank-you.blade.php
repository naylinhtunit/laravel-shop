@extends('frontend.layouts.master')

@section('title','Checkout page')

@section('main-content')
<div class="container py-5">
    <div class="row">
        <div class="text-center">
            <h1 class="display-4 lh-lg">Thanks for your order!</h1>
            <p class="lead mb-3">
                We appreciate your order! If you have any questions, please email.
                <a href="{{route('product-grids')}}" style="color:blue;">Continue shopping</a>
            </p>
        </div>
    </div>
</div>
@endsection