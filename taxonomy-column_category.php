<?php /* Template name: Column Page */ ?>  

<?php get_header(); ?>
			<div id="content-top" class="m-section">
				<div id="m-header">
					<?php
						if (is_tax() || is_category() || is_tag() ){
								    $qobj = get_queried_object();
								    // var_dump($qobj); // debugging only
								
								    // concatenate the query
								    $args = array(
								      'posts_per_page' => 1,
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
								
								    $lastCustom = new WP_Query( $args );
								    // var_dump($random_query); // debugging only
								
								    if ($lastCustom->have_posts()) {
								        while ($lastCustom->have_posts()) {
								          $lastCustom->the_post();
								          // Display
								
								
				global $post;
				//get the right thumbnail
				$thumb_id = get_post_thumbnail_id();
				$thumb_url = wp_get_attachment_image_src($thumb_id,'thumb-big', true);
				$thumb= $thumb_url[0];
			
    				?>
					<div class="featured-background"><div class="featured-background-shade"></div></div>
					<h1 class="page-title"><?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); echo $term->name; ?><div class="m-border"></div></h1>
					<div class="featured-last" <?php if ( has_post_thumbnail() ) { ?>style="background-image:url('<?php echo $thumb; ?>');"  <?php } ?>>
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="divLink"></a>
						<h2 class="last-category">
							<?php $lastTerms = get_the_terms( $post->ID , 'column_category' );

foreach ( $lastTerms as $lastTerm ) {

echo $lastTerm->name;

} ?><div class="m-border"></div>
						</h2>
						<h1 class="last-title"><?php the_title(); ?></h1>
						<div class="overlay"></div> 
						<div class="gradient"></div>
					</div>
					<?php
							}
						}
						}
    				?>
				</div>
				<div id="m-nav">
					<?php

					$taxonomy = 'column_category';

					$tax_args = array(
					'hide_empty'        => false, 
					'exclude'           => array(), 
					'exclude_tree'      => array(), 
					'include'           => array(),
					); 

					$terms = get_terms($taxonomy, $tax_args); // Get all terms of a taxonomy

					if ( $terms && !is_wp_error( $terms ) ) : ?>
						<ul>
							<li><a href="/rubriche">Tutti</a></li>
								<?php foreach ( $terms as $term ) { ?>
							<li><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?></a></li>
								<?php } ?>
    					</ul>
    					
					<?php endif;?>
				</div>
			</div>
			<div id="content-container" class="wrap">
				<div id="content">			
					<div id="inner-content" class="clearfix">
				
					    <div id="main" class="clearfix" role="main">
						    
						    <?php get_sidebar('column'); ?>
						    
						    <div id="articles" class="tasc-grid">
								
						    
						    	<div id="articles-content">
							    	<?php 
								    	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
								if (is_tax() || is_category() || is_tag() ){
								    $qobj = get_queried_object();
								    // var_dump($qobj); // debugging only
								
								    // concatenate the query
								    $args = array(
								      'posts_per_page' => 9,
								      'paged' => $paged,
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
								
								    $columnCategory = new WP_Query( $args );
								    // var_dump($random_query); // debugging only
								
								    if ($columnCategory->have_posts()) {
								        while ($columnCategory->have_posts()) {
								          $columnCategory->the_post();
								          // Display
							        get_template_part( 'loop','bigstory');
							        
							        } }?>
							        
								</div>
										
								
								
								
						    </div><!-- end articles -->
						    
						    
						        <?php if (get_next_posts_link() or get_previous_posts_link()) {  ?>
								        <nav class="wp-prev-next button-container">
									        <ul class="clearfix">
										        <li class="prev-link"><?php next_posts_link('Vai nel passato') ?></li>
										        <li class="next-link"><?php previous_posts_link('Torna al presente') ?></li>
									        </ul>
								        </nav>
							        <?php } } ?>		

					    </div> <!-- end #main -->
					</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
			</div>  <!-- end #content-container -->    
<?php get_footer(); ?>