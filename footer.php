		
		</div> <!-- end #container -->
		<footer class="footer" role="contentinfo"
			<?php
			//seleziono immagine casuale per sfondo footer
				$imagesDir = get_template_directory()."/library/images/hero/";
				  $images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
				  shuffle($images);
				  
				$randomImage=array_pop($images);						
			?>
			style="background-image:url('<?php echo get_stylesheet_directory_uri();  echo "/library/images/hero/"; echo basename($randomImage); ?>');"
			>
		
			<div id="inner-footer" class="wrap clearfix">
				<div class="footer-first-row">
					<div class="social-links">
						<ul>
							<li><a target="_blank" href="http://www.facebook.com/tascproject"><span class="iconfont">a</span>Facebook</a></li>
							<li><a target="_blank" href="http://www.twitter.com/tascproject"><span class="iconfont">b</span>Twitter</a></li>
							<li><a target="_blank" href="http://feedpress.me/tasc"><span class="iconfont">d</span>Feed</a></li>
						</ul>
					</div>
					<div class="newsletter">
						<span class="footer-title">ISCRIVITI ALLA NEWSLETTER</span>
						<?php if( function_exists( 'mc4wp_show_form' ) ) { mc4wp_show_form(58912); } ?>
					</div>
				</div>
				<div class="footer-second-row">
					<?php //bones_footer_links();  il menu diventerà automatico quando sarà rimosso il logo di tasc ?>
					<ul class="footer-menu">
						<li><a href="https://tasc.it/ciao">Ciao</a></li>
						<li><a href="https://tasc.it/cast">Cast</a></li>
						<li class="tasc"></li>
						<li><a href="https://tasc.it/partnership">Partnership</a></li>
					</ul>
				</div>
				<div class="footer-third-row">
					Powered by <a href="http://grafite.io">Grafite</a>, designed and developed by <a href="http://albertoziveri.com">Alberto Ziveri</a> & Matteo Pelosi | <a href="https://tasc.it/disclaimer">Legal Policy</a>
				</div>
				
				
				
				
				<!--<div class="footer-menu">
					<div class="column">
					Tasc è stato fondato nel Settembre 2012, è un magazine indipendente no-profit che scopre e analizza le innovazioni da ogni punto di vista, sostenuto da ragazzi tra i 15 ed i 40 anni.
					</div>
					<div class="column">
						<ul>
							<li><a href="http://www.tasc.it/entra-nel-cast">Entra nel Cast</a></li>
							<li><a href="http://www.tasc.it/partnership">Diventa Partner</a></li>
							<li><a href="http://www.tasc.it/disclaimer">Legal Policy</a></li>
							<li><a href="http://www.grafite.io">Grafite</a></li>
						</ul>
					</div>
					<div class="column">
					</div>
					<div class="column">
						Design e tema realizzato internamente da <a href="http://www.albertoziveri.com">Alberto Ziveri</a> con il supporto di Matteo Pelosi.
					</div>
				</div>-->
			</div> <!-- end #inner-footer -->
			
		</footer> <!-- end footer -->
		<?php 
		//Se non è mobile mostro il Facebook Like BOX dentro un modal, con jquery cookie che controlla ecc.
		global $detect;
		if($detect->isMobile() && !$detect->isTablet()) {} else { ?>
		<div id="fblikebox">
		    <h1 class="mediumone">Seguici per leggere</h1>
		    	<p>Le pagine che andrai a leggere sono pagine create con passione da un team giovane e intraprendente. Segui il progetto Tasc su Facebook.</p>
		      <div class="fb-like-box" data-href="https://www.facebook.com/tascproject" data-height="200" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="true"></div>
		      <p>Se non hai Facebook seguici su Twitter!</p>
		      <p><a href="https://twitter.com/tascproject" class="twitter-follow-button">Follow @tascproject</a>    
 <script src="//platform.twitter.com/widgets.js" type="text/javascript"></script></p>
		      <a href="#" class="modal_close">Non ho Facebook ne Twitter o vi seguo già</a>
		</div>		
		<a id="fblikebox-open" href="#fblikebox" style="display:none;">
		<?php } ?>
        
        
        <!-- FULL SCREEN IN POST IMAGES -->
            <?php if ( is_single() ) {?>	
	<script  type="text/javascript">	
		jQuery(document).ready(function($) {
		/*FULL SCREEN IMAGE*/
		$(function(){
			var w = $(window).width();
			var pW = $(".single .post").width();
			var setMargin = (pW - w)/2;
			$(".post-content img.full_screen_img").css("max-width", "none");
			$(".post-content img.full_screen_img").css('width',w);
			$(".post-content img.full_screen_img").css('margin-left',(setMargin) + "px");
		    $(window).resize(function(){
				var w = $(window).width();
				var pW = $(".single .post").width();
				var setMargin = (pW - w)/2;
				$(".post-content img.full_screen_img").css("max-width", "none");
				$(".post-content img.full_screen_img").css('width',w);
				$(".post-content img.full_screen_img").css('margin-left',(setMargin) + "px");
		    });
		});
		
		});
    </script>
            <?php } ?> 
        <!-- END FULL SCREEN IN POST IMAGES -->
        
        <!-- SHRINKING HEADER -->
        <?php if ( !is_single() ) {?>	
		<script  type="text/javascript">
		jQuery(document).ready(function($) {	
		$(function() {
		    //caches a jQuery object containing the header element
		    var header = $("header.header");
		    $(window).scroll(function() {
		        var scroll = $(window).scrollTop();
		
		        if (scroll >= 500) {
		            header.addClass("smaller");
		        } else {
		            header.removeClass("smaller");
		        }
		    });
		});
		});
		</script>
            <?php } ?> 
        <!-- SHRINKING HEADER -->
        
        
		<!-- SET HEIGHT TO MAIN STOR in homepage -->
        <?php if ( is_home() ) {?>	
	<script  type="text/javascript">	
		jQuery(document).ready(function($) {
			$(function(){
	var msh = $("#main-story").height();
	$("#top-stories").css('height',msh);
	$(window).resize(function(){
		var msh = $("#main-story").height();
		$("#top-stories").css('height',msh);
    });
			});
});
    </script>
            <?php } ?> 
        <!-- SET HEIGHT TO MAIN STORY -->
            
		<?php wp_footer(); // js scripts are inserted using this function ?>

<script type='text/javascript'>var _merchantSettings=_merchantSettings || [];_merchantSettings.push(['AT', '11lK8x']);(function(){var autolink=document.createElement('script');autolink.type='text/javascript';autolink.async=true; autolink.src= ('https:' == document.location.protocol) ? 'https://autolinkmaker.itunes.apple.com/js/itunes_autolinkmaker.js' : 'http://autolinkmaker.itunes.apple.com/js/itunes_autolinkmaker.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(autolink, s);})();</script>
	</body>

</html> <!-- end page. what a ride! -->