			<div id="sidebar">
				<div id="feedly-sidebar" class="sidebar-section">
					
				</div>
				<section id="article-sidebar" class="sidebar-section">
					<div class="s-section-title clearfix">
						<div class="s-title-border"></div>
						<div class="s-title-background">
							<span class="s-title">Articoli</span>
							<div class="s-title-white-triangle"></div>
						</div>
					</div>
					<div>
								<?php 
									$sidebar_snacks = new WP_Query( array('showposts' => 2,'tax_query' => array(array('taxonomy' => 'post_format','field' => 'slug','terms' => 'post-format-aside'))));
									while ( $sidebar_snacks->have_posts() ) : $sidebar_snacks->the_post(); 
									get_template_part( 'loop','bigstory' ); 
									endwhile; 
								?>
					</div>
				</section>
				<section id="column-sidebar" class="sidebar-section">
					<div class="s-section-title clearfix">
						<div class="s-title-background">
							<span class="s-title"><a href="https://www.tasc.it/rubriche">Rubriche</a></span>
						</div>
					</div>
					<div>
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
										<ul class="s-column-container">
												<?php foreach ( $terms as $term ) { ?>
											<li class="s-column-single" style="background-image: url(<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url($term->term_id); ?>); background-size: cover;">
												<div class="outer-mask">
													<div class="inner-mask">
														<div class="content"></div>
        											</div>
    											</div>
    											<a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"></a>
    											<h2 class="subtitle"><?php echo term_description( $term->term_id, $taxonomy ) ?></h2>
    											<h1 class="title"><?php echo $term->name; ?></h1>
    										</li>
												<?php } ?>
    									</ul>
    									
									<?php endif;?>
					</div>
				</section>
			</div>