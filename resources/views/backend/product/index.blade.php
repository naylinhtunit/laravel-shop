@extends('backend.layouts.master')

@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <div class="dropdown">
        <h6 class="btn btn-primary btn-sm dropdown-toggle text-light m-0 font-weight-bold text-primary float-left" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-eye"></i> Product Lists</h6>
      
        <div class="dropdown-menu px-3" aria-labelledby="dropdownMenuLink">
          <div class="custom-control custom-switch">
            <input type="checkbox" name="id" class="custom-control-input" id="id" checked>
            <label class="custom-control-label" for="id">S.N.</label>
          </div>
          <div class="custom-control custom-switch">
            <input type="checkbox" name="title" class="custom-control-input" id="title" checked>
            <label class="custom-control-label" for="title">Title</label>
          </div>
          <div class="custom-control custom-switch">
            <input type="checkbox" name="category" class="custom-control-input" id="category" checked>
            <label class="custom-control-label" for="category">Category</label>
          </div>
          <div class="custom-control custom-switch">
            <input type="checkbox" name="is_featured" class="custom-control-input" id="is_featured">
            <label class="custom-control-label" for="is_featured">Is Featured</label>
          </div>
          <div class="custom-control custom-switch">
            <input type="checkbox" name="price" class="custom-control-input" id="price" checked>
            <label class="custom-control-label" for="price">Price</label>
          </div>
          <div class="custom-control custom-switch">
            <input type="checkbox" name="discount" class="custom-control-input" id="discount" checked>
            <label class="custom-control-label" for="discount">Discount</label>
          </div>
          <div class="custom-control custom-switch">
            <input type="checkbox" name="size" class="custom-control-input" id="size">
            <label class="custom-control-label" for="size">Size</label>
          </div>
          <div class="custom-control custom-switch">
            <input type="checkbox" name="condition" class="custom-control-input" id="condition">
            <label class="custom-control-label" for="condition">Condition</label>
          </div>
          <div class="custom-control custom-switch">
            <input type="checkbox" name="brand" class="custom-control-input" id="brand" checked>
            <label class="custom-control-label" for="brand">Brand</label>
          </div>
          <div class="custom-control custom-switch">
            <input type="checkbox" name="stock" class="custom-control-input" id="stock">
            <label class="custom-control-label" for="stock">Stock</label>
          </div>
          <div class="custom-control custom-switch">
            <input type="checkbox" name="photo" class="custom-control-input" id="photo" checked>
            <label class="custom-control-label" for="photo">Photo</label>
          </div>
          <div class="custom-control custom-switch">
            <input type="checkbox" name="status" class="custom-control-input" id="status" checked>
            <label class="custom-control-label" for="status">Status</label>
          </div>
        </div>
      </div>
      @if (Auth::check() && Auth::user()->role->id == 1)
      <a href="{{route('admin-product.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Product</a>
      @elseif (Auth::check() && Auth::user()->role->id == 2)
      <a href="{{route('manager-product.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Product</a>
      @endif
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($products)>0)
        <table class="table table-bordered" id="product-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="id">S.N.</th>
              <th class="title">Title</th>
              <th class="category">Category</th>
              <th class="is_featured">Is Featured</th>
              <th class="price">Price</th>
              <th class="discount">Discount</th>
              <th class="size">Size</th>
              <th class="condition">Condition</th>
              <th class="brand">Brand</th>
              <th class="stock">Stock</th>
              <th class="photo">Photo</th>
              <th class="status">Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="id">S.N.</th>
              <th class="title">Title</th>
              <th class="category">Category</th>
              <th class="is_featured">Is Featured</th>
              <th class="price">Price</th>
              <th class="discount">Discount</th>
              <th class="size">Size</th>
              <th class="condition">Condition</th>
              <th class="brand">Brand</th>
              <th class="stock">Stock</th>
              <th class="photo">Photo</th>
              <th class="status">Status</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
           
            @foreach($products as $product)   
              @php 
              $sub_cat_info=DB::table('categories')->select('title')->where('id',$product->child_cat_id)->get();
              // dd($sub_cat_info);
              $brands=DB::table('brands')->select('title')->where('id',$product->brand_id)->get();
              @endphp
                <tr>
                    <td class="id">{{$product->id}}</td>
                    <td class="title">{{$product->title}}</td>
                    <td class="category">{{$product->cat_info['title']}}
                      <sub>
                        @foreach($sub_cat_info as $data)
                          {{$data->title}}
                        @endforeach
                      </sub>
                    </td>
                    <td class="is_featured">{{(($product->is_featured==1)? 'Yes': 'No')}}</td>
                    <td class="price">Rs. {{$product->price}} /-</td>
                    <td class="discount">  {{$product->discount}}% OFF</td>
                    <td class="size">{{$product->size}}</td>
                    <td condition>{{$product->condition}}</td>
                    <td class="brand">@foreach($brands as $brand) {{$brand->title}} @endforeach</td>
                    <td class="stock">
                      @if($product->stock>0)
                      <span class="badge badge-primary">{{$product->stock}}</span>
                      @else 
                      <span class="badge badge-danger">{{$product->stock}}</span>
                      @endif
                    </td>
                    <td class="photo">
                        @if($product->photo)
                            @php 
                              $photo=explode(',',$product->photo);
                              // dd($photo);
                            @endphp
                            <img src="{{$photo[0]}}" class="img-fluid zoom" style="max-width:80px" alt="{{$product->photo}}">
                        @else
                            <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid" style="max-width:80px" alt="avatar.png">
                        @endif
                    </td>
                    <td class="status">
                        @if($product->status=='active')
                            <span class="badge badge-success">{{$product->status}}</span>
                        @else
                            <span class="badge badge-warning">{{$product->status}}</span>
                        @endif
                    </td>
                    <td>
                      @if (Auth::check() && Auth::user()->role->id == 1)
                      <a href="{{route('admin-product.edit',$product->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                      <form method="POST" action="{{route('admin-product.destroy',[$product->id])}}">
                      @elseif (Auth::check() && Auth::user()->role->id == 2)
                      <a href="{{route('manager-product.edit',$product->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                      <form method="POST" action="{{route('manager-product.destroy',[$product->id])}}">
                      @endif
                        @csrf 
                        @method('delete')
                        <button class="btn btn-danger btn-sm dltBtn" data-id={{$product->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                      </form>
                    </td>
                </tr>  
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$products->links()}}</span>
        @else
          <h6 class="text-center">No Products found!!! Please create Product</h6>
        @endif
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
	<!-- Sweet-alert CSS -->
	<script src="{{asset('backend/css/sweetalert.min.css')}}"></script>
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
      .zoom {
        transition: transform .2s; /* Animation */
      }

      .zoom:hover {
        transform: scale(5);
      }
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
	<!-- Sweet-alert JS -->
	<script src="{{asset('backend/js/sweetalert.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>
      
      $('#product-dataTable').DataTable( {
        "scrollX": false
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[10,11,12]
                }
            ]
        } );

        function deleteData(id){
            
        }
  </script>
  <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
              // alert(dataID);
              e.preventDefault();
              swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("Your data is safe!");
                    }
                });
          })
      })
  </script>
  <script>
    // show / hide table columns
    $("input:checkbox:not(:checked)").each(function() {
      var column = "table ." + $(this).attr("name");
      $(column).hide();
    });

    $("input:checkbox").click(function(){
        var column = "table ." + $(this).attr("name");
        $(column).toggle();
    });
  </script>
@endpush