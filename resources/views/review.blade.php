@extends('layouts.new')
@section('content')
<section class="mt-6 is-large">
	<div class="">
		<div class="columns is-mobile is-justify-content-center">
			<div class="column is-flex-grow-0 is-10-mobile is-5-tablet is-4-desktop is-3-widescreen is-3-fullhd">
				<progress class="progress is-small" value="100" max="100"></progress>
				@if (isset($user->status))
				<div class="has-text-centered">
					<form action="{{ route('signOut') }}" method="POST">
					@csrf
						<div class="mt-6">
							<div class="mt-3">
								<h5 class="title is-6">Thank you for complete the registration you profile is under review now.</h5>
								<h6 class="subtitle is-6 has-text-weight-bold mt-3">Update will notify you by SMS</h6>
							</div>
						</div>
						<div class="mt-4">
							<button class="button is-primary is-rounded is-fullwidth">Logout</button>
						</div>
					</form>	  
				</div>
				@else
				<div class="has-text-centered">
					<form action="">
						<div class="mt-6">
							<div class="mt-3">
								<h5 class="title is-6">You profile is under review.</h5>
								<h6 class="subtitle is-6 has-text-weight-bold mt-3">Update will notify you by SMS</h6>
							</div>
						</div>		
					</form>
				  
				</div>	
				@endif
			</div>
		</div>
	</div>
</section>

@endsection