<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>BRUM BRUM CRUD</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="<?php echo e(route('user.create')); ?>"> Create New User</a>
            </div>
        </div>
    </div>

    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Password</th>
            <th>Rol</th>
            <th>Detail</th>
            <th>Other Info</th>
            <th>Photo</th>
            <th>Google ID</th>
        </tr>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $users): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($users->id); ?></td>
            <td><?php echo e($users->username); ?></td>
            <td><?php echo e($users->email); ?></td>
            <td><?php echo e($users->name); ?></td>
            <td><?php echo e($users->surname); ?></td>
            <td><?php echo e($users->password); ?></td>
            <td><?php echo e($users->rol); ?></td>
            <td><?php echo e($users->detail); ?></td>
            <td><?php echo e($users->otherInformation); ?></td>
            <td><?php echo e($users->photo); ?></td>
            <td><?php echo e($users->googleID); ?></td>
            <td>
                <form action="<?php echo e(route('user.destroy',$users->id)); ?>" method="POST">   
                    <a class="btn btn-info" href="<?php echo e(route('user.show',$users->id)); ?>">Show</a>    
                    <a class="btn btn-primary" href="<?php echo e(route('user.edit',$users->id)); ?>">Edit</a>   
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\BrumBrumCrud\brumBrumCRUD\resources\views/user/index.blade.php ENDPATH**/ ?>