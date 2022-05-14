@extends('layouts.new')
@section('content')

        <div class="columns is-mobile is-justify-content-center">
            <div class="column is-flex-grow-0 is-12-mobile is-5-tablet is-4-desktop is-5-widescreen is-5fullhd">
		
	@if (\Session::has('success'))

	<div class="alert alert-success">

		{!! \Session::get('success') !!}

	</div>

	@elseif(\Session::has('failed'))

	<div class="alert alert-danger">

		{!! \Session::get('failed') !!}

	</div>

	@endif<div class="columns">	
	 <div class="column is-flex-grow-0 is-12-mobile is-9-tablet is-9-desktop is-9-widescreen is-9-fullhd">
		 <form id="custom-search-form" action="{{ route('dashboard') }}" method="get">
			<div class="input-append spancustom">
							
					<input type="text" class="search-query input is-primary" value="{{request()->get('q')}}" data-role="tagsinput" name="q" placeholder="Keyword">
				
			</div>
		</form>    
		</div> 
		<div class="column is-flex-grow-0 is-12-mobile is-3-tablet is-3-desktop is-3-widescreen is-3-fullhd">
		<button type="buttom" id="formSearch" class="button is-primary is-rounded is-fullwidth">Search</button>
		</div></div>
			@if(!empty($posts))
			@foreach($posts as $post)	
					
            <a href="{{ route('post.view',$post->slug) }}" class="linkCourses">
                <div class="my-5">
                <p class="title is-5 has-text-left m-0" style="white-space: pre-wrap;color:#BD3F39; font-size:18px; font-weight:bold; line-height:28px;">{{ucfirst($post->title)}}</p> 
			</a>
                <div class="mt-4 subtitle is-5" style="text-align:justify;font-size:14px !important; color:#000!important;margin-top:10px;">
					<?PHP 
					$url = route('post.view',$post->slug);
					$string =  $post->content;					
					if (strlen($string) > 400) {
						$stringCut = substr($string, 0, 400);
						$endPoint = strrpos($stringCut, ' ');	
						$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
						$string .= '... <a href="'.$url.'" style="color:#000;font-weight:bold;">more >></a>';
					}
					echo $string;
			         ?>
				</div>
			
                <hr class="dropdown-divider" style="border:block;background-color:#ccc">
                </div>
           	<p style="margin-top:1.5rem;"></p>
		   @endforeach
		   @endif  
			<div class="is-inline-flex">
			
		   {{ $posts->links() }}
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
<script>
  $(function () {
    // Summernote
    $('#post-content').summernote({
	height: 200,  
	toolbar: [
		// [groupName, [list of button]]
		['style', ['bold', 'italic', 'underline']],
		['para', ['ul', 'ol', 'paragraph']],
		["view", ["fullscreen"]]
	],
	callbacks: {
		onPaste: function (e) {
        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
        e.preventDefault();
        document.execCommand('insertText', false, bufferText);
		}
	  }
	});
	
	 $(".dropdown-toggle").click(function(){
		 $(this).parents('.btn-group:first').find('.dropdown-menu').toggle();
	  });
  })
  
	$('.bootstrap-tagsinput > input').keypress(function (e) {
		var key = e.which;
		alert(key);
		if(key == 13){			
			return false;  
		}
	});   
  
/*   $('#formSearch').click(function(e) {
	  alert();
        $("#custom-search-form").submit();
    }); */
  
/*   $("#custom-search-form").submit(function(e) {
		e.preventDefault(); // <==stop page refresh==>
		
	}); */
	$("#formSearch").click(function(e){		
		//var key = e.which;
		//alert(key);
		$("#custom-search-form").submit();
	}); 
</script>

@endsection