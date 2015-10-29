<?php /* Template name: Shop Page */ ?>  

<?php get_header(); ?>
			<div id="content-top" class="m-section">
				<div id="m-header">
					<div class="featured-background"><div class="featured-background-shade"></div></div>
					<h1 class="page-title">Tasc Shop<div class="m-border"></div></h1>
					<h2 class="page-subtitle">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</h2>
					<div id="featured-product-container">
					<?php
						$lastCustom = new WP_Query( 'post_type=product&posts_per_page=3' );
						if ($lastCustom->have_posts()) {
							while ($lastCustom->have_posts()) {
								$lastCustom->the_post();
								
								
				global $post;
				//get the right thumbnail
				$thumb_id = get_post_thumbnail_id();
				$thumb_url = wp_get_attachment_image_src($thumb_id,'thumb-big', true);
				$thumb= $thumb_url[0];
			
    				?>
					<div class="featured-product" <?php if ( has_post_thumbnail() ) { ?>style="background-image:url('<?php echo $thumb; ?>');"  <?php } ?>>
						<h1 class="product-title"><?php the_title(); ?></h1>
						<span class="featured-price">$33.00</span>
					</div>
					<?php
							}
						}
    				?>
					</div>
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
	    				<div id="main" role="main">
		    				<article class="product">
			    				<div class="thumb"></div>
			    				<span class="brand">Swatch</span>
			    				<span class="price">$33.00</span>
			    				<h1 class="product-name">Orologio di vacca mutante</h1>
		    				</article>
		    				<div class="gap"></div>
	    				</div>
					</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
			</div>  <!-- end #content-container -->    
<?php get_footer(); ?>