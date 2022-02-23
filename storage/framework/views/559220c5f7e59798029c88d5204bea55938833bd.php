

<?php $__env->startSection('main-content'); ?>
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            <?php echo $__env->make('backend.layouts.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
      <?php if(Auth::check() && Auth::user()->role->id == 1): ?>
      <a href="<?php echo e(route('admin-category.create')); ?>" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Category</a>
      <?php elseif(Auth::check() && Auth::user()->role->id == 2): ?>
      <a href="<?php echo e(route('manager-category.create')); ?>" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Category</a>
      <?php endif; ?>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <?php if(count($categories)>0): ?>
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
           
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
              <?php 
              $parent_cats=DB::table('categories')->select('title')->where('id',$category->parent_id)->get();
              // dd($parent_cats);

              ?>
                <tr>
                    <td class="id"><?php echo e($category->id); ?></td>
                    <td class="title"><?php echo e($category->title); ?></td>
                    <td class="slug"><?php echo e($category->slug); ?></td>
                    <td class="is_parent"><?php echo e((($category->is_parent==1)? 'Yes': 'No')); ?></td>
                    <td class="is_child_parent"><?php echo e((($category->is_child_parent==2)? 'Yes': 'No')); ?></td>
                    <td class="parent_category">
                        <?php $__currentLoopData = $parent_cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent_cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($parent_cat->title); ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td class="photo">
                        <?php if($category->photo): ?>
                            <img src="<?php echo e($category->photo); ?>" class="img-fluid" style="max-width:80px" alt="<?php echo e($category->photo); ?>">
                        <?php else: ?>
                            <img src="<?php echo e(asset('backend/img/thumbnail-default.jpg')); ?>" class="img-fluid" style="max-width:80px" alt="avatar.png">
                        <?php endif; ?>
                    </td>
                    <td class="status">
                        <?php if($category->status=='active'): ?>
                            <span class="badge badge-success"><?php echo e($category->status); ?></span>
                        <?php else: ?>
                            <span class="badge badge-warning"><?php echo e($category->status); ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                      <?php if(Auth::check() && Auth::user()->role->id == 1): ?>
                      <a href="<?php echo e(route('admin-category.edit',$category->id)); ?>" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                      <form method="POST" action="<?php echo e(route('admin-category.destroy',[$category->id])); ?>">
                      <?php elseif(Auth::check() && Auth::user()->role->id == 2): ?>
                      <a href="<?php echo e(route('manager-category.edit',$category->id)); ?>" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                      <form method="POST" action="<?php echo e(route('manager-category.destroy',[$category->id])); ?>">
                      <?php endif; ?>
                        <?php echo csrf_field(); ?> 
                        <?php echo method_field('delete'); ?>
                        <button class="btn btn-danger btn-sm dltBtn" data-id=<?php echo e($category->id); ?> style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                      </form>
                    </td>
                </tr>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
        <span style="float:right"><?php echo e($categories->links()); ?></span>
        <?php else: ?>
          <h6 class="text-center">No Categories found!!! Please create Category</h6>
        <?php endif; ?>
      </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
  <link href="<?php echo e(asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
	<!-- Sweet-alert CSS -->
	<script src="<?php echo e(asset('backend/css/sweetalert.min.css')); ?>"></script>
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
  </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>

  <!-- Page level plugins -->
  <script src="<?php echo e(asset('backend/vendor/datatables/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
	<!-- Sweet-alert JS -->
	<script src="<?php echo e(asset('backend/js/sweetalert.min.js')); ?>"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo e(asset('backend/js/demo/datatables-demo.js')); ?>"></script>
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\NL\Documents\Applications\isure\resources\views/backend/category/index.blade.php ENDPATH**/ ?>