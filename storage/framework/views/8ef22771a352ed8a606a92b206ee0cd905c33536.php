<?php $__env->startSection('content'); ?>
<div class="my-6 columns is-mobile is-justify-content-center">
    <div class="column is-flex-grow-0 is-11-mobile is-10-tablet is-8-desktop is-8-widescreen is-6-fullhd">
        <div class="m-4">
            <div class="is-flex is-justify-content-space-between is-flex-wrap-wrap">
                <div class="my-2">
                    <h4 class="title is-5 mb-2"><?php echo e($post->title); ?></h4>
                    <div class="is-flex">
                        <div class="mx-3">
                            <figure class="image is-32x32">
                                <img src="<?= URL::to('/'); ?>/frontend/img/group.png" />
                            </figure>
                        </div>
                        <div class="mx-3">
                            <figure class="image is-32x32">
                                <img src="<?= URL::to('/'); ?>/frontend/img/level.png" />
                            </figure>
                        </div>
                        <div class="mx-3">
                            <figure class="image is-32x32">
                                <img src="<?= URL::to('/'); ?>/frontend/img/map.png" />
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="my-2">
                    <button class="button is-danger is-medium">Content Me</button>
                </div>
            </div>
        </div>
        <div class="my-4">
            <p class="subtitle is-6" style="white-space: pre-line;">
			<?php echo e(nl2br($post->content)); ?>

            </p>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\XAMPP\htdocs\teacher\resources\views/post_view.blade.php ENDPATH**/ ?>