
<?php $__env->startSection('MainContent'); ?>


<div class="row form-container">
    <div id="accordion">
        <h2>Groups --> Materials</h2>
        <?php $__currentLoopData = $course->group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card">
                <div class="card-header" id="heading<?php echo e($group->id); ?>">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo e($group->id); ?>" aria-expanded="true" aria-controls="collapse<?php echo e($group->id); ?>" style="text-decoration: none; width: 150px;">
                            <span style="font-size: 24px;"><?php echo e($group->name); ?></span>
                        </button>
                    </h5>
                </div>

                <div id="collapse<?php echo e($group->id); ?>" class="collapse" aria-labelledby="heading<?php echo e($group->id); ?>" data-parent="#accordion">
                    <div class="card-body">
                        <?php $__currentLoopData = $group->materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p style="font-size: 18px;"><?php echo e($material->name); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MI\Desktop\laravel\task3\resources\views/admin/material.blade.php ENDPATH**/ ?>