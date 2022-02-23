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
        <h6 class="btn btn-primary btn-sm dropdown-toggle text-light m-0 font-weight-bold text-primary float-left" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-eye"></i> Category Lists</h6>
      
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
            <input type="checkbox" name="slug" class="custom-control-input" id="slug" checked>
            <label class="custom-control-label" for="slug">Slug</label>
          </div>
          <div class="custom-control custom-switch">
            <input type="checkbox" name="is_parent" class="custom-control-input" id="is_parent">
            <label class="custom-control-label" for="is_parent">Is Parent</label>
          </div>
          <div class="custom-control custom-switch">
            <input type="checkbox" name="is_child_parent" class="custom-control-input" id="is_child_parent">
            <label class="custom-control-label" for="is_child_parent">Is Child Parent</label>
          </div>
          <div class="custom-control custom-switch">
            <input type="checkbox" name="parent_category" class="custom-control-input" id="parent_category" checked>
            <label class="custom-control-label" for="parent_category">Parent Category</label>
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
      <a href="{{route('admin-category.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Category</a>
      @elseif(Auth::check() && Auth::user()->role->id == 2)
      <a href="{{route('manager-category.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Category</a>
      @endif
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($categories)>0)
        <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="id">S.N.</th>
              <th class="title">Title</th>
              <th class="slug">Slug</th>
              <th class="is_parent">Is Parent</th>
              <th class="is_child_parent">Is Child Parent</th>
              <th class="parent_category">Parent Category</th>
              <th class="photo">Photo</th>
              <th class="status">Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="id">S.N.</th>
              <th class="title">Title</th>
              <th class="slug">Slug</th>
              <th class="is_parent">Is Parent</th>
              <th class="is_child_parent">Is Child Parent</th>
              <th class="parent_category">Parent Category</th>
              <th class="photo">Photo</th>
              <th class="status">Status</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
           
            @foreach($categories as $category)   
              @php 
              $parent_cats=DB::table('categories')->select('title')->where('id',$category->parent_id)->get();
              // dd($parent_cats);

              @endphp
                <tr>
                    <td class="id">{{$category->id}}</td>
                    <td class="title">{{$category->title}}</td>
                    <td class="slug">{{$category->slug}}</td>
                    <td class="is_parent">{{(($category->is_parent==1)? 'Yes': 'No')}}</td>
                    <td class="is_child_parent">{{(($category->is_child_parent==2)? 'Yes': 'No')}}</td>
                    <td class="parent_category">
                        @foreach($parent_cats as $parent_cat)
                            {{$parent_cat->title}}
                        @endforeach
                    </td>
                    <td class="photo">
                        @if($category->photo)
                            <img src="{{$category->photo}}" class="img-fluid" style="max-width:80px" alt="{{$category->photo}}">
                        @else
                            <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid" style="max-width:80px" alt="avatar.png">
                        @endif
                    </td>
                    <td class="status">
                        @if($category->status=='active')
                            <span class="badge badge-success">{{$category->status}}</span>
                        @else
                            <span class="badge badge-warning">{{$category->status}}</span>
                        @endif
                    </td>
                    <td>
                      @if (Auth::check() && Auth::user()->role->id == 1)
                      <a href="{{route('admin-category.edit',$category->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                      <form method="POST" action="{{route('admin-category.destroy',[$category->id])}}">
                      @elseif (Auth::check() && Auth::user()->role->id == 2)
                      <a href="{{route('manager-category.edit',$category->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                      <form method="POST" action="{{route('manager-category.destroy',[$category->id])}}">
                      @endif
                        @csrf 
                        @method('delete')
                        <button class="btn btn-danger btn-sm dltBtn" data-id={{$category->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                      </form>
                    </td>
                </tr>  
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$categories->links()}}</span>
        @else
          <h6 class="text-center">No Categories found!!! Please create Category</h6>
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
      
      $('#banner-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[3,4,5]
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