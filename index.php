<?php get_header(); ?>
			<?php if (is_paged()) { } else { ?>
			<div id="content-top">
				<div id="top-stories">
					<div id="main-story" class="big-story left-column">		
							<?php query_posts('showposts=3'); ?>
							<?php if (have_posts()) : while (have_posts()) : the_post(); 
							//NON INSERISCO IN TOP STORIES POST non importanti.
							$important= get_post_meta($post->ID, 'opt_notbig', true); if( $important == "on" ) continue;
							if(empty($do_not_duplicate)) {} else { if( in_array($post->ID, $do_not_duplicate) ) continue;}
							
							$do_not_duplicate[] = $post->ID; ?>
								<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix main-post permalink'); ?> role="article">
								<?php get_template_part( 'loop','bigstory' ); ?>	
								</article>
								
							<?php break; endwhile; ?>	
							<?php endif; ?>
					</div> <!-- End first-stories -->
											
					<div id="side-story"  class="right-column">
						<div class="last-opinions opinion-story">
								<?php 
									$last_opinions = new WP_Query( array( 'post_type' => 'opinion', 'showposts' => 1 )  );
									while ( $last_opinions->have_posts() ) : $last_opinions->the_post(); 
								?>
								<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix main-post permalink'); ?> role="article">
								<?php get_template_part( 'loop','bigstory' ); ?>	
								</article>
								<?php endwhile; ?>
						</div>
						
						<div class="snack-story">
							
<?php 
								
								//Inizializzo query
								if (is_paged()) {wp_reset_query();   } else { query_posts('showposts=10'); } ?>
								
								<?php 
								
								while (have_posts()) : the_post(); 
								
								//Se è uno snack NON salta
								$format = get_post_format();
								if ($format == 'aside') {} else {continue;}
								
								//Se è già stato messo prima lo salta
								if(empty($do_not_duplicate)) {} else { if( in_array($post->ID, $do_not_duplicate) ) continue;}
								
								$do_not_duplicate[] = $post->ID;
								
								get_template_part( 'loop','bigstory' );

								break;
								endwhile;
								
							?>
						</div>

					</div> 
				</div><!-- End top-stories -->
			</div>
			<?php } //solo se è la home mostra le top-stories ?>
			
			<div id="content-container" class="wrap">
				<div id="content">			
					<div id="inner-content" class="clearfix">
				
					    <div id="main" class="clearfix" role="main">
						    <div id="articles" class="tasc-grid">
								
						    
						    	<div class="left-column">
									<?php wp_reset_query(); if (have_posts()) : while (have_posts()) : the_post(); 
									
										//Se è uno snack salta
										$format = get_post_format();
										if ($format == 'aside') { continue;}
										
										//Se è già stato messo prima lo salta
										if(empty($do_not_duplicate)) {} else { if( in_array($post->ID, $do_not_duplicate) ) continue;}
										
										$do_not_duplicate[] = $post->ID;
										
										get_template_part( 'loop','bigstory');
										//$i++; 
										endwhile;
									?>
								</div>
										
								
								
								
						    </div><!-- end articles -->
						    
						    <?php get_sidebar(); ?>
						    
						        <?php if (get_next_posts_link() or get_previous_posts_link()) {  ?>
								        <nav class="wp-prev-next button-container">
									        <ul class="clearfix">
										        <li class="prev-link"><?php next_posts_link('Vai nel passato') ?></li>
										        <li class="next-link"><?php previous_posts_link('Torna al presente') ?></li>
									        </ul>
								        </nav>
							        <?php }  ?>		
							    <?php endif; ?>
					    </div> <!-- end #main -->
					</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
			</div>  <!-- end #content-container -->    

<?php get_footer(); ?>
