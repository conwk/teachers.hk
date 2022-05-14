@extends('layouts.new')
@section('content')

        <div class="columns is-mobile is-justify-content-center">
            <div class="column is-flex-grow-0 is-12-mobile is-5-tablet is-4-desktop is-5-widescreen is-5-fullhd">
		
	@if (\Session::has('success'))

	<div class="alert alert-success">

		{!! \Session::get('success') !!}

	</div>

	@elseif(\Session::has('failed'))

	<div class="alert alert-danger">

		{!! \Session::get('failed') !!}

	</div>

	@endif
		<div class="my-6">
		     @if(!empty($contact))
		 @php $key = 0 @endphp
		     	@foreach($contact as $contacts)	
				
		     <p class="title is-5 has-text-left m-0" style="white-space: pre-wrap;color:#BD3F39; font-size:18px;margin-bottom:1rem; font-weight:bold;line-height:26px;">MSG {{$key+1}} | {{$contacts->contact}}</p> 
                <p class="mt-4 subtitle is-6" style="color:#000;font-size:14px;">{{$contacts->message}}</p>
                <hr class="dropdown-divider" style="border:block;background-color:#ccc">
	
                @php $key++ @endphp
          
			<p style="margin-top:1rem"></p>
                       
		   @endforeach
		
		   @endif
<div class="is-inline-flex">		   
		   {{ $contact->links() }}
		   </div>
		   </div>
		
		     </div>
        </div>
   
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<style>
.note-editor.note-frame.fullscreen{
	position:fixed;
	top:30%;
	width:600px!important;
	left:30%;
	height:350px;
}
.note-editable ol, ul{
	margin-left:10px;
}
</style>

@endsection