<?php $__env->startSection('content'); ?>
<section class="mt-6 is-large">
	<div class="">
		<div class="columns is-mobile is-justify-content-center">
			<div class="column is-flex-grow-0 is-10-mobile is-5-tablet is-4-desktop is-3-widescreen is-3-fullhd">
					<div class="has-text-centered">
						<form action="<?php echo e(route('registration.update')); ?>" method="POST">
						<?php echo csrf_field(); ?>
							<div class="mt-6">
								<input name="first_name" class="input is-primary" type="text" placeholder="Full name as per HKID" value="<?php echo e(isset($user->first_name) ? $user->first_name : old('first_name')); ?>" required >
							</div>
							<div class="mt-2">
								<input name="dob" class="input is-primary" type="date" placeholder="Date of Birth" required value="<?php echo e(isset($user->dob) ? $user->dob : old('dob')); ?>" >
							</div>
							<div class="mt-2">
								<div class="field">
									<p class="control has-icons-left has-icons-right">
									  <input name="email" class="input is-primary" type="email" required placeholder="Email" value="<?php echo e(isset($user->email) ? $user->email : old('email')); ?>">
									  <span class="icon is-small is-left">
										<i class="fas fa-envelope"></i>
									  </span>
									  <span class="icon is-small is-right">
										<i class="fas fa-check"></i>
									  </span>
									</p>
								  </div>
							</div>
							<div class="mt-3">
								<button class="button is-primary is-rounded is-fullwidth">Done</button>
							</div>
						</form>	
					</div>
					
			</div>
		</div>
	</div>
</section>	

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\XAMPP\htdocs\teacher\resources\views/registration.blade.php ENDPATH**/ ?>