

<?php $__env->startSection('main-content'); ?>
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            <?php echo $__env->make('admin.layouts.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Post Lists</h6>
      <a href="<?php echo e(route('post.create')); ?>" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Post</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <?php if(count($posts)>0): ?>
        <table class="table table-bordered" id="product-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Title</th>
              <th>Category</th>
              <th>Tag</th>
              <th>Author</th>
              <th>Photo</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>S.N.</th>
              <th>Title</th>
              <th>Category</th>
              <th>Tag</th>
              <th>Author</th>
              <th>Photo</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
           
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
              <?php 
              $author_info=DB::table('users')->select('name')->where('id',$post->added_by)->get();
              // dd($sub_cat_info);
              // dd($author_info);

              ?>
                <tr>
                    <td><?php echo e($post->id); ?></td>
                    <td><?php echo e($post->title); ?></td>
                    <td><?php echo e($post->cat_info->title); ?></td>
                    <td><?php echo e($post->tags); ?></td>

                    <td>
                      <?php $__currentLoopData = $author_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php echo e($data->name); ?>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <?php if($post->photo): ?>
                            <img src="<?php echo e($post->photo); ?>" class="img-fluid zoom" style="max-width:80px" alt="<?php echo e($post->photo); ?>">
                        <?php else: ?>
                            <img src="<?php echo e(asset('backend/img/thumbnail-default.jpg')); ?>" class="img-fluid" style="max-width:80px" alt="avatar.png">
                        <?php endif; ?>
                    </td>                   
                    <td>
                        <?php if($post->status=='active'): ?>
                            <span class="badge badge-success"><?php echo e($post->status); ?></span>
                        <?php else: ?>
                            <span class="badge badge-warning"><?php echo e($post->status); ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('post.edit',$post->id)); ?>" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="<?php echo e(route('post.destroy',[$post->id])); ?>">
                      <?php echo csrf_field(); ?> 
                      <?php echo method_field('delete'); ?>
                          <button class="btn btn-danger btn-sm dltBtn" data-id=<?php echo e($post->id); ?> style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
        <span style="float:right"><?php echo e($posts->links()); ?></span>
        <?php else: ?>
          <h6 class="text-center">No posts found!!! Please create Post</h6>
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
      .zoom {
        transition: transform .2s; /* Animation */
      }

      .zoom:hover {
        transform: scale(5);
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
      
      $('#product-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[8,9,10]
                }
            ]
        } );

        // Sweet alert

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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\NL\Documents\Applications\isure\resources\views\admin\post\index.blade.php ENDPATH**/ ?>