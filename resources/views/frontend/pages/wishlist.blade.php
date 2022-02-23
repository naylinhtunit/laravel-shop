@extends('frontend.layouts.master')
@section('title','Wishlist Page')
@section('main-content')
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{('home')}}">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="javascript:void(0);">Wishlist</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
			
	<!-- Shopping Cart -->
	<div class="shopping-cart section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- Shopping Summery -->
					<table class="table shopping-summery">
						<thead>
							<tr class="main-hading">
								<th>PRODUCT</th>
								<th>NAME</th>
								<th class="text-center">TOTAL</th> 
								<th class="text-center">ADD TO CART</th> 
								<th class="text-center"><i class="ti-trash remove-icon"></i></th>
							</tr>
						</thead>
						<tbody>
							@if(count(Helper::getAllProductFromWishlist()) > 0)
								@foreach(Helper::getAllProductFromWishlist() as $key=>$wishlist)
									<tr class="wishlist-content">
										@php 
											$photo=explode(',',$wishlist->product['photo']);
											@endphp
										<td class="image" data-title="No"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></td>
										<td class="product-des" data-title="Description">
											<p class="product-name"><a href="{{route('product-detail',$wishlist->product['slug'])}}">{{$wishlist->product['title']}}</a></p>
											<p class="product-des">{!!($wishlist['summary']) !!}</p>
										</td>
										<td class="total-amount" data-title="Total"><span>{{$wishlist['amount']}} MMK</span></td>
										<td><a href="{{route('add-to-cart',$wishlist->product['slug'])}}" class='btn text-white'>Add To Cart</a></td>
										<td class="action" data-title="Remove">
											<input type="hidden" class="wishlist_id" value="{{ $wishlist->id }}">
											<a href="{{route('wishlist-delete', $wishlist->id)}}" class="remove-from-wishlist"><i class="ti-trash remove-icon"></i></a>
										</td>
									</tr>
								@endforeach
							@else 
								<tr>
									<td class="text-center">
										There are no any wishlist available. <a href="{{route('product-grids')}}" style="color:blue;">Continue shopping</a>

									</td>
								</tr>
							@endif


						</tbody>
					</table>
					<!--/ End Shopping Summery -->
				</div>
			</div>
		</div>
	</div>
	<!--/ End Shopping Cart -->
@endsection
@push('scripts')
	{{-- <script>
		$(document).ready(function(){
			$('.remove-from-wishlist').click(function (e) { 
				e.preventDefault();
				
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				
				var ele = $(this);
				var wishlist_id = $(ele).closest('.wishlist-content').find('.wishlist_id').val();
				

				$.ajax({
					type: "GET",
					url: "{{route('wishlist-delete')}}",
					data: {
						id: wishlist_id,
					},
					success: function (response) {
						$(ele).closest('.wishlist-content').remove();
						swal(response.status);
					}
				});
			});
		});
	</script> --}}
@endpush