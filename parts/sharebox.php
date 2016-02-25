	    <div id="share-box">
		    <div class="share">
		    	<div class="share-count">
		    		<span class="count"><?php $url1 = get_permalink(); $url2 = get_permalink(); $url2 = preg_replace("/^https:/i", "http:", $url2); $total =  getsocialcount($url1) + getsocialcount($url2);  echo $total; ?></span>
		    		<span class="shares-name">shares</span>
		    	</div>
		    	<div class="share-it">
		    		<ul class="tasc-social">
		    			<?php $title = urlencode(get_the_title()); ?>
		    			<li><a id="fbshare" class="facebook" onclick="javascript:fbshare('<?php urlencode(the_permalink());?>/','<?php echo $title; ?>')" href="javascript:return(0);"><span class="iconfont icon">a</span></a></li>
		    			
		    			<li><a id="twittershare" class="twitter" onclick="javascript:twittershare('<?php urlencode(the_permalink()); ?>','<?php echo $title; ?>')" href="javascript:return(0);"  target="blank"><span class="iconfont icon">b</span></a></li>
		    			<li><a id="googleshare" class="gplus" onclick="javascript:googleshare('<?php the_permalink();?>','<?php echo $title; ?>')" href="javascript:return(0);" target="blank" ><span class="iconfont icon">k</span></a></li>
		    		</ul>
		    	</div>
		    </div>
		    
		    <div class="sponsor">
		    	<div class="advertisement">
					<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
					<!-- TASC -->
					<ins class="adsbygoogle"
					     style="display:inline-block;width:320px;height:50px"
					     data-ad-client="ca-pub-5429493370716580"
					     data-ad-slot="7405024950"></ins>
					<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
					</script>
		    	</div>
		    </div>
	    </div>
