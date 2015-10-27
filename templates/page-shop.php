<?php /* Template name: Video Page */ ?>  

<?php get_header(); ?>
			<div id="content-top" class="m-section">
				<div id="m-header">
					<?php
						$lastCustom = new WP_Query( 'post_type=product&posts_per_page=1' );
						if ($lastCustom->have_posts()) {
							while ($lastCustom->have_posts()) {
								$lastCustom->the_post();
								
								
				global $post;
				//get the right thumbnail
				$thumb_id = get_post_thumbnail_id();
				$thumb_url = wp_get_attachment_image_src($thumb_id,'thumb-big', true);
				$thumb= $thumb_url[0];
			
    				?>
					<div class="featured-background"<?php if ( has_post_thumbnail() ) { ?>style="background-image:url('<?php echo $thumb; ?>');"  <?php } ?>><div class="featured-background-shade"></div></div>
					<h1 class="page-title">Tasc Shop<div class="m-border"></div></h1>
					<div class="featured-last" <?php if ( has_post_thumbnail() ) { ?>style="background-image:url('<?php echo $thumb; ?>');"  <?php } ?>>
						<h2 class="last-category">
							<?php
								$lastTerms = get_the_terms($post->ID, 'product_category' );
									if ($lastTerms && ! is_wp_error($lastTerms)) :
										$term_slugs_arr = array();
										foreach ($lastTerms as $term) {
											$term_slugs_arr[] = $term->slug;
										}
										$terms_slug_str = join( " ", $term_slugs_arr);
									endif;
									echo $terms_slug_str;
							?><div class="m-border"></div>
						</h2>
						<h1 class="last-title"><?php the_title(); ?></h1>
					</div>
					<?php
							}
						}
    				?>
				</div>
				<div id="m-nav">
					<?php

					$taxonomy = 'product_category';

					$tax_args = array(
					'hide_empty'        => false, 
					'exclude'           => array(), 
					'exclude_tree'      => array(), 
					'include'           => array(),
					); 

					$terms = get_terms($taxonomy, $tax_args); // Get all terms of a taxonomy

					if ( $terms && !is_wp_error( $terms ) ) : ?>
						<ul>
							<li><a href="/video">Tutti</a></li>
								<?php foreach ( $terms as $term ) { ?>
							<li><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?></a></li>
								<?php } ?>
    					</ul>
    					
					<?php endif;?>
				</div>
			</div>
			<div id="content-container" class="wrap">
				<div id="content" class="full-width">
					<div id="inner-content" class="clearfix">
	    				
					</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
			</div>  <!-- end #content-container -->    
<?php get_footer(); ?>