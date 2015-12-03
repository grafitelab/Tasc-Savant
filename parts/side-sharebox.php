<div id="side-post-sharebox">
	<ul>
		<li><a class="savant-heart-side" id="heart-side"></a></li>
		<li><a class="savant-facebook-side" id="fbshare-side" onclick="javascript:fbshare('<?php urlencode(the_permalink());?>/','<?php echo $title; ?>')" href="javascript:return(0);"></a></li>
		<li><a class="savant-twitter-side" id="twittershare-side" onclick="javascript:twittershare('<?php urlencode(the_permalink()); ?>','<?php echo $title; ?>')" href="javascript:return(0);"  target="blank"></a></li>
		<li><a class="savant-gplus-side" id="googleshare-side" onclick="javascript:googleshare('<?php the_permalink();?>','<?php echo $title; ?>')" href="javascript:return(0);" target="blank"></a></li>
	</ul>
</div>