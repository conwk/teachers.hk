<?php $__env->startSection('content'); ?> 
    <div class="my-6 columns is-mobile is-justify-content-center">
      <div class="column is-flex-grow-0 is-11-mobile is-10-tablet is-8-desktop is-8-widescreen is-6-fullhd">
        <div class="is-relative is-inline-block">
            <figure class="image is-128x128">
				<?php if(!empty($user->photo) && file_exists(public_path('/frontend/teacher/'.$user->photo))): ?>
				<img class="is-rounded" src="<?= URL::to('/'); ?>/frontend/teacher/<?php echo e($user->photo); ?>">
				<?php else: ?>
					<img class="is-rounded"  src="<?= URL::to('/'); ?>/frontend/img/flatProfile.png">	
				<?php endif; ?>
                
              </figure>
              <div class="absolute" style="position:absolute;bottom: 0;right: 0;">
                <figure class="image is-48x48">
                    <img src="<?= URL::to('/'); ?>/frontend/img/flatCheck.png">
                  </figure>
              </div>
           </div>
           <div class="m-4">
               
                <div class="is-flex is-justify-content-space-between is-flex-wrap-wrap">
                    <div class="my-2">
                        <h4 class="title is-5 mb-2"><?php echo e($user->first_name); ?></h4>
                        <div class="is-flex">
						<?php
							$socialLinks = (!empty($user->social_links)?json_decode($user->social_links):"");
						?>
							<?php if(!empty($socialLinks->twitter)): ?>
                           <div class="mx-1"><a href="<?php echo e($socialLinks->twitter); ?>" target="_blank">
                            <figure class="image is-32x32">
                                <img src="<?= URL::to('/'); ?>/frontend/img/twitter.png">
                              </figure>
							  </a>
                           </div>
						   <?php endif; ?>
						   <?php if(!empty($socialLinks->linkedin)): ?>
                           <div class="mx-1">
							<a href="<?php echo e($socialLinks->linkedin); ?>" target="_blank">
                            <figure class="image is-32x32">
                                <img src="<?= URL::to('/'); ?>/frontend/img/linkedin.png">
                              </figure>
							 </a> 
                           </div>
						    <?php endif; ?>
							<?php if(!empty($socialLinks->instagram)): ?>
							   <div class="mx-1">
								<a href="<?php echo e($socialLinks->instagram); ?>" target="_blank">
								<figure class="image is-32x32">
									<img src="<?= URL::to('/'); ?>/frontend/img/facebook.png">
								  </figure>
							   </div>
							   </a>
                              <?php endif; ?> 
                        </div>
                    </div>
                    <div class="my-2">
                        <a href="<?php echo e(route('profile.view',$user->profile_id )); ?>" class="button is-danger is-medium">Contact Me</a>
                    </div>
                </div>
           </div>
           <div class="">
			<p><?php echo $user->about_us ?></p>
           </div>
           <div class="my-6">
            <h4 class="title is-4">My Courses</h4>
			<?php if(!empty($posts)): ?>
			<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>			
            <button class="m-0 button is-justify-content-space-between is-flex-wrap-wrap" style="background-color: transparent !important; width: 100%;height: 100%;">
                <div class="my-2">
                    <p class="subtitle is-5 has-text-left" style="white-space: pre-wrap;"><?php echo e($post->title); ?></p>
                </div>
                <div class="my-2">
                    <div class="is-flex is-flex-wrap-wrap">
                        <div>
                            <figure class="image is-32x32 mx-2">
                                <img src="<?= URL::to('/'); ?>/frontend/img/group1.png">
                              </figure> 
                        </div>
                        <div>
                            <figure class="image is-32x32 mx-2">
                                <img src="<?= URL::to('/'); ?>/frontend/img/level.png">
                              </figure> 
                        </div>
                        <div>
                            <figure class="image is-32x32 mx-2">
                                <img src="<?= URL::to('/'); ?>/frontend/img/map.png">
                              </figure> 
                        </div>
                        <div>
                            <p class="subtitle is-5 mx-2"><a href="<?= URL::to('/'); ?>/post/<?php echo e($post->slug); ?>">Details</a></p>
                        </div>
                </div>
            </div>
           </button>
		   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		   <?php endif; ?>           
		   </div>
      </div>
    </div>
   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\XAMPP\htdocs\teacher\resources\views/profile.blade.php ENDPATH**/ ?>