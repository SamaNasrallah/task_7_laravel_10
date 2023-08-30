
<?php $__env->startSection('MainContent'); ?>


<div class="row form-container">
    <div class="row form-container">
        <div class="col-md-3" >
            <form id="categoryForm" action="<?php echo e(route('group.store', ['course_id' => $course_id])); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="_method" id="method" value="POST">
                <input type="hidden" name="course_id" value="<?php echo e($course_id); ?>">
            
                <div class="form-group">
                    <label for="group">Group</label>
                    <input type="text" name="name" id="name" class="form-control" style="width: 400px; height: 40px;">
                </div>
                <button type="submit" class="btn btn-primary" id="btn-primary">Save</button>
            </form>
  
        </div>
       
        <div class="col-md-3" >
            <table class="table table-success table-striped" style="width: 400px">
                <thead>
                    <tr style="text-align: center;">
                        <th>ID</th>
                        <th>Group</th>
                        <th>Material</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($group->id); ?></td>
                        <td><?php echo e($group->name); ?></td>
                        <td>
                            <a class="btn btn-info" href="<?php echo e(route('mate.index',$group->id)); ?>">
                                Material
                              </a>
                        </td>
                        <td>
                            <a class="btn btn-primary edit-category" data-id="<?php echo e($group->id); ?>" data-name="<?php echo e($group->name); ?>">
                                Edit
                            </a>
                        </td>
                        <td>
                            <form action="<?php echo e(route('group.destroy', $group->id)); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-delete" data-material-count="<?php echo e($group->materials->count()); ?>">
                                    Delete
                                </button>
                            </form>
                        </td>
                      
                    
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>

  
    <script>
          $(document).ready(function() {
            $(".edit-category").click(function() {
            var categoryName = $(this).data("name");
            var categoryId = $(this).data("id");

            $("#categoryForm").attr("action", "<?php echo e(route('group.update', '')); ?>/" + categoryId);
            $("#method").val("PUT");

            $("#name").val(categoryName);

        });

        $("#btn-primary").click(function() {
            alert("Added/Updated Group successfully");
        });

        $(".btn-delete").click(function() {
            var fileCount = $(this).data("material-count");
            return confirmDelete(fileCount);
        });

        function confirmDelete(fileCount) {
            if (fileCount > 0) {
                return confirm('Are you sure you want to delete the Group? Group contains ' + fileCount + ' material and they will be deleted too!');
            } else {
                alert("Group is empty , do you want to delete it already? ");
            }

            return true;
        }

    });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MI\Desktop\laravel\task3\resources\views/admin/createGroup.blade.php ENDPATH**/ ?>