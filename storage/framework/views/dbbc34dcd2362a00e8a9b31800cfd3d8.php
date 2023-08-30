
<?php $__env->startSection('MainContent'); ?>
<br>
<?php if(session('error')): ?>
    <div class="alert alert-danger" style=" position: fixed;   top: 0;
              left: 50%;
              transform: translateX(-50%);
              z-index: 1000;
              width:600px;
              text-align: center;">
        <?php echo e(session('error')); ?>

    </div>

<?php endif; ?>
<?php if(session('success')): ?>
    <div class="alert alert-success" style=" position: fixed;   top: 0;
              left: 50%;
              transform: translateX(-50%);
              z-index: 1000;
              width:600px;
              text-align: center;">
        <?php echo e(session('success')); ?>

    </div>

<?php endif; ?>


    <a href="<?php echo e(url('mat/create/'.$group_id)); ?>" class="btn btn-success" style="font-size: 18px">Create_Material</a>
<table id="myTable" class="table table-success table-striped" >

    <thead>
    <tr style="text-align: center;">
        <th>ID</th>
        <th>Name Material</th>
        <th>File</th>
        <th>Link</th>
        <th>Show Link</th>
        <th>Show Pdf</th>
        <th>Download</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
</thead>

<tbody>
    <?php $__currentLoopData = $matGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $corr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <tr>
        <td><?php echo e($corr->id); ?></td>
        <td><?php echo e($corr->name); ?></td> 
        <td><?php echo e($corr->file); ?></td>
        <td><?php echo e($corr->link); ?></td>
        
            <td>
                <?php if($corr->link): ?>
                    <a href="<?php echo e($corr->link); ?>" target="_blank">
                        <i class="fas fa-link"></i>
                    </a>
                    <?php else: ?>
                    <span>
                        <i class="fas fa-link" style="color: gray;"></i> 
                    </span>
                <?php endif; ?>
            </td>
        <td>
            <?php if($corr->file && pathinfo($corr->file, PATHINFO_EXTENSION) === 'pdf'): ?>
    <a href="<?php echo e(route('material.show', $corr->id)); ?>">
        <i class="fas fa-eye"></i>
    </a>
<?php else: ?>
    <span>
        <i class="fas fa-eye" style="color: gray;"></i> 
    </span>
<?php endif; ?>
            
        </td>
        <td>
            <?php if($corr->file): ?>
                <a href="<?php echo e(Storage::url($corr->filePath)); ?>" download>
                    <i class="fas fa-download"></i>
                </a>
                <?php else: ?>
                <span>
                   <i class="fas fa-download" style="color: gray;"></i> 
                </span>
             
            <?php endif; ?>
        </td>
        <td>
            <a class="btn btn-primary" href="<?php echo e(route('material.edit',$corr->id)); ?>">
                Edit
            </a>
        </td>
        <td>
            <form action="<?php echo e(route('material.destroy', $corr->id)); ?>" method="post">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger" id="btn-delete-co">
                    Delete
                </button>
            </form>
        </td>
    </tr>
    
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <script>
        $(document).ready(function() {
           $("#btn-delete-co").click(function() {
              alert("Material Deleted successfully");
          });
        });
     </script>

</tbody>
<script>
    $(document).ready(function () {
  $('#myTable').DataTable({
    "paging": true,
    "ordering": true,
    "searching": true,
    "initComplete": function () {
        $('#myTable').css('width', '80%');
        $('#myTable_wrapper').css('margin-left', '100px');
    }
  });
});
</script>


</table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MI\Desktop\laravel\task3\resources\views/admin/viewMat.blade.php ENDPATH**/ ?>