<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>	
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">	
	<title>teacher.hk</title>	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />	
	<link rel="stylesheet" href="<?php echo e(asset('/frontend/css/style.css?t=1.3')); ?>" />	
	<link rel="stylesheet" href="<?php echo e(asset('/frontend/css/main/bulma.min.css')); ?>" />	
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" ></script>	
	<link rel="stylesheet" href="<?php echo e(asset('/frontend/css/amsify.suggestags.css')); ?>" />	
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="<?php echo e(asset('/frontend/js/jquery.amsify.suggestags.js')); ?>"></script>
	<style>
	ul.home-tag {padding: 10px;}

ul.home-tag li {display: inline-block;
    margin: 0px 5px;    padding: 10px 0px;}

ul.home-tag li:first-child {margin-left: 0;}

ul.home-tag li a {padding: 5px 15px;background: #d8d8d8;
    color: black;font-size: 14px;border-radius: 15px;}
	</style>
</head>
<body>
<div id="body-content" class="is-relative">	
	<header class="mt-6">		
		<div class="columns is-mobile">
			<div class="column is-2-desktop is-offset-5-desktop is-4-mobile is-offset-4-mobile is-3-tablet is-offset-5-tablet">				
				<img src="<?= URL::to('/'); ?>/frontend/img/logo.png" width="300" />
			</div>	
		</div>	
	</header>	
	<div class="columns is-mobile is-justify-content-center">
		<div class="column is-flex-grow-0 is-12-mobile is-5-tablet is-4-desktop is-5-widescreen is-5fullhd">	
			<div class="columns">		
				<div class="column is-flex-grow-0 is-12-mobile is-9-tablet is-9-desktop is-9-widescreen is-9-fullhd">			
					<form id="custom-search-form" action="<?php echo e(route('search')); ?>" method="get">
						<div class="input-append spancustom">	
							<input type="text" id="search_tag" class="search-query input is-primary" value="<?php echo e(request()->get('q')); ?>" data-role="tagsinput" name="q" placeholder="Keyword">
						</div>					
					</form>    			
				</div> 				
				<div  class="column is-flex-grow-0 is-12-mobile is-3-tablet is-3-desktop is-3-widescreen is-3-fullhd">	
					<button type="buttom" id="formSearch" class="button is-primary is-rounded is-fullwidth">Search</button>				
				</div>	
			</div>			
			<?php //print_r($posts); ?>			
				<?php if(!empty(request()->get('q'))): ?>	
					<?php if(!empty($posts)): ?>		
						<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
						<div class="my-5">					
							<a href="<?php echo e(route('post.view',$post->slug)); ?>" class="linkCourses">  
								<p class="title is-5 has-text-left m-0" style="white-space: pre-wrap;color:#BD3F39; font-size:18px; font-weight:bold; line-height:28px;"><?php echo e(ucfirst($post->title)); ?></p>
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
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>		  
					<?php endif; ?>  		
				<div class="is-inline-flex">	
					<?php echo e($posts->links()); ?>		  
				</div>	
				<?php else: ?>
					<?php 
						if(isset($dataTag) && !empty($dataTag)){
							$newTagArr = array();
							foreach($dataTag as $data){
								$newTag = explode(',', $data['tags']);
								foreach($newTag as $newTags){
									$newTagArr[] = trim($newTags);
								}
							}					
				
							

							$valArr = array_count_values($newTagArr);
							echo '<ul class="home-tag">';		
								foreach($valArr as $key=>$vals){
									echo '<li>';	
										echo '<a href="https://teacher.dvgsoft.com/public/?q='.$key.'">'.$key.' ('.$vals.')</a>';
									echo '</li>';		
								}
							echo '</ul>';
						}
					?>
				<?php endif; ?> 
				
			</div>	
		</div>	
	<footer class="footer has-background-white" style="padding: 1rem 1.5rem 6rem;">             
		<div class="columns">             
		<div class="content has-text-centered column is-4 is-offset-4">       
		<p class="is-size-7">             
		By Continuing, you are confirming that you have read and agree to our <span class="colorChange">Terms and Conditions</span>, <span class="colorChange">Privacy Policy</span> and <span class="colorChange">Cookie Policy</span></p>                   
		</div>             
		</div>          
	</footer>
</div>	
<script type="text/javascript">	
	$('input[name="q"]').amsifySuggestags({	
		suggestions: <?php echo json_encode($newArrayUnique) ?>	
	});	
	$("#formSearch").click(function(e){	
		$("#custom-search-form").submit();
	}); 
</script>
</body>
</html><?php /**PATH /home/dvgsaeae/teacher.dvgsoft.com/resources/views/search.blade.php ENDPATH**/ ?>