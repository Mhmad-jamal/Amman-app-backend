<?php if (isset($component)) { $__componentOriginald8bdefe537b868c30952851c478827a760077823 = $component; } ?>
<?php $component = App\View\Components\Layouts\Base::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layouts.base'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Layouts\Base::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>


    <?php if(in_array(request()->route()->getName(),
            [
                'dashboard',
                'profile',
                'edit_user',
                'profile-example',
                'users',
                'bootstrap-tables',
                'transactions',
                'buttons',
                'forms',
                'modals',
                'notifications',
                'typography',
                'upgrade-to-pro',
            ])): ?>
        
        <?php echo $__env->make('layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <?php echo $__env->make('layouts.sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <main class="content">
            
            <?php echo $__env->make('layouts.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo e($slot); ?>

            
            <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </main>
    <?php elseif(in_array(request()->route()->getName(),
            [
                'register',
                'register-example',
                'login',
                'login-example',
                'forgot-password',
                'forgot-password-example',
                'reset-password',
                'reset-password-example',
            ])): ?>
        <?php echo e($slot); ?>

        
        <?php echo $__env->make('layouts.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php elseif(in_array(request()->route()->getName(),
            ['404', '500', 'lock'])): ?>
        <?php echo e($slot); ?>

    <?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8bdefe537b868c30952851c478827a760077823)): ?>
<?php $component = $__componentOriginald8bdefe537b868c30952851c478827a760077823; ?>
<?php unset($__componentOriginald8bdefe537b868c30952851c478827a760077823); ?>
<?php endif; ?>
<?php /**PATH D:\github\Amman-app-backend\resources\views/layouts/app.blade.php ENDPATH**/ ?>