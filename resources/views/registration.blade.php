@extends('layouts.new')
@section('content')
<section class="mt-6 is-large">
	<div class="">
		<div class="columns is-mobile is-justify-content-center">
			<div class="column is-flex-grow-0 is-10-mobile is-5-tablet is-4-desktop is-3-widescreen is-3-fullhd">
					<div class="has-text-centered">
						<form action="{{ route('registration.update') }}" method="POST">
						@csrf
							<div class="mt-6">
								<input name="first_name" class="input is-primary" type="text" placeholder="Full name as per HKID" value="{{isset($user->first_name) ? $user->first_name : old('first_name') }}" required >
							</div>
							<div class="mt-2">
								<input name="dob" class="input is-primary" type="date" placeholder="Date of Birth" required value="{{isset($user->dob) ? $user->dob : old('dob') }}" >
							</div>
							<div class="mt-2">
								<div class="field">
									<p class="control has-icons-left has-icons-right">
									  <input name="email" class="input is-primary" type="email" required placeholder="Email" value="{{isset($user->email) ? $user->email : old('email') }}">
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

@endsection