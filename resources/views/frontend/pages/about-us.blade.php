@extends('frontend.layouts.master')

@section('title','Laravel-Shop || About Us')

@section('main-content')

	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{ route('home') }}">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="{{ route('about-us') }}">About Us</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
	
	<!-- About Us -->
	<section class="about-us section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-12">
						<div class="about-content">
							@php
								$settings=DB::table('settings')->get();
							@endphp
							<h3>Welcome To <span>Isure</span></h3>
							<p>@foreach($settings as $data) {{$data->description}} @endforeach</p>
						</div>
					</div>
				</div>
			</div>
	</section>
	<!-- End About Us -->
@endsection