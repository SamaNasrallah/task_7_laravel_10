
<?php $__env->startSection('MainContent'); ?>

<div class="row form-container">
    <div class="col-md-3">
        <form  action="<?php echo e(route('material.update', $material->id)); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <?php echo method_field('PUT'); ?> 
            <div class="form-group">
                <label for="name">Material Name:</label>
                <input type="text" name="name" id="name" value="<?php echo e($material->name); ?>" class="form-control" style="width: 400px; height: 40px;">
            </div>
            <div class="form-group">
                <label for="file">File:</label>
                <input type="file" name="file" id="file" class="form-control-file" style="width: 400px; height: 40px;" onchange="toggleFields()">
                <?php if($material->file): ?>
                    <p>The File: <?php echo e($material->file); ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="link">Link:</label>
                <input type="text" name="link" id="link" value="<?php echo e($material->link); ?>" class="form-control" style="width: 400px; height: 40px;" <?php echo e($material->file ? 'disabled' : ''); ?> oninput="toggleFields()">
            </div>
                
            <button type="submit" class="btn btn-primary">Save</button>

        </form>
    </div>
</div>
<script>
    function toggleFields() {
        var fileInput = document.getElementById("file");
        var linkInput = document.getElementById("link");

        if (fileInput.value !== "") {
            linkInput.disabled = true;
        } else if (linkInput.value !== "") {
            fileInput.disabled = true;
        } else {
            fileInput.disabled = false;
            linkInput.disabled = false;
        }
    }
    toggleFields();
</script>
<script>
    $(document).ready(function() {
        $(".btn-delete").click(function() {
            alert("Delete successfully");
        });

        $("#btn-primary").click(function() {
            alert("Added/Updated Category successfully");
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MI\Desktop\laravel\task3\resources\views/admin/editMate.blade.php ENDPATH**/ ?>