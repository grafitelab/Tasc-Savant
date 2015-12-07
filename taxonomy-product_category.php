<?php /* Template name: Shop Page */ ?>  

<?php get_header(); ?>
			<div id="content-top" class="m-section">
				<div id="m-header">
					<div class="featured-background"><div class="featured-background-shade"></div></div>
					<h1 class="page-title"><?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); echo $term->name; ?><div class="m-border"></div></h1>
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
				$thumb_url = wp_get_attachment_image_src($thumb_id,'thumb-normal', true);
				$thumb= $thumb_url[0];
				$productCustomMeta = get_post_meta($post->ID,'_my_meta',TRUE);
			
    				?>
					<div class="featured-product" <?php if ( has_post_thumbnail() ) { ?>style="background-image:url('<?php echo $thumb; ?>'); background-size: cover;"  <?php } ?>>
						<a class="absoluteLink" href="<?php the_permalink() ?>"></a>
						<h1 class="product-title"><?php the_title(); ?></h1>
						<span class="featured-price"><?php $productCustomMeta['price'] ?></span>
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
		    				<?php 
								if (is_tax() || is_category() || is_tag() ){
								    $qobj = get_queried_object();
								    // var_dump($qobj); // debugging only
								
								    // concatenate the query
								    $args = array(
								      'posts_per_page' => 9,
								      'tax_query' => array(
								        array(
								          'taxonomy' => $qobj->taxonomy,
								          'field' => 'id',
								          'terms' => $qobj->term_id,
								    //    using a slug is also possible
								    //    'field' => 'slug', 
								    //    'terms' => $qobj->name
								        )
								      )
								    );
								
								    $productCategory = new WP_Query( $args );
								    // var_dump($random_query); // debugging only
								
								    if ($productCategory->have_posts()) {
								        while ($productCategory->have_posts()) {
								          $productCategory->the_post();
								          // Display
									
				global $post;
				//get the right thumbnail
				$thumb_id = get_post_thumbnail_id();
				$thumb_url = wp_get_attachment_image_src($thumb_id,'thumb-normal', true);
				$thumb= $thumb_url[0];
				$productCustomMeta = get_post_meta($post->ID,'_my_meta',TRUE);
			
    				?>
		    				<article class="product">
			    				<div class="thumb" <?php if ( has_post_thumbnail() ) { ?>style="background-image:url('<?php echo $thumb; ?>'); background-size: cover;"  <?php } ?>><a class="absoluteLink" href="<?php the_permalink() ?>"></a></div>
			    				<span class="brand"><?php echo $productCustomMeta['brand'] ?></span>
			    				<span class="price"><?php if ($productCustomMeta['discounted-price'] != ""){ echo "<span class='discounted-price'>".$productCustomMeta['price'].'</span> | '.$productCustomMeta['discounted-price'];} else if ($productCustomMeta['price'] != "") { echo $productCustomMeta['price']; }?></span>
			    				<h1 class="product-name"><?php the_title(); ?></h1>
		    				</article>
		    				<?php } } }?>
	    				</div>
					</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
			</div>  <!-- end #content-container -->    
			
<?php get_footer(); ?>