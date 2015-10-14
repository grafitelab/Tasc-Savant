<?php /* Template name: Hello page */ ?>  

<?php get_header(); ?>
			<div id="content-top" class="m-section">
				<div id="m-header">
					<div class="featured-background"></div>
					<div class="featured-last">
						<h2 class="last-category"></h2>
						<h1 class="last-title"></h1>
					</div>
				</div>
				<div id="m-nav">
					<?php 
						/*
						$args = array(
						'type'                     => 'post',
						'child_of'                 => 0,
						'parent'                   => '',
						'orderby'                  => 'name',
						'order'                    => 'ASC',
						'hide_empty'               => 1,
						'hierarchical'             => 1,
						'exclude'                  => '',
						'include'                  => '',
						'number'                   => '',
						'taxonomy'                 => 'category',
						'pad_counts'               => false 

						); 
						
						$categories = get_categories( $args ); 
						
						foreach ( $categories as $category ) {
							echo '<li><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></li>';
						}
						*/
					?> 
				</div>
			</div>
			<div id="content-container" class="wrap">
				<div id="content" class="full-width">
					<div id="inner-content" class="clearfix">
	    				
					</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
			</div>  <!-- end #content-container -->    
<?php get_footer(); ?>