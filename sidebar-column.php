			<div id="sidebar">
				<div id="feedly-sidebar" class="sidebar-section">
					
				</div>
				<section id="article-sidebar" class="sidebar-section">
					<div class="s-section-title clearfix">
						<div class="s-title-border"></div>
						<div class="s-title-background">
							<span class="s-title">Articoli in evidenza</span>
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
						<div class="s-title-border"></div>
						<div class="s-title-background">
							<span class="s-title">Rubriche</span>
							<div class="s-title-white-triangle"></div>
						</div>
						<a href="#">Tutte le rubriche ></a>
					</div>
					<div style="width: 100%;height: 300px;border: 1px solid;box-sizing: border-box;">
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
												<?php foreach ( $terms as $term ) { ?>
											<li><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?></a></li>
												<?php } ?>
    									</ul>
    									
									<?php endif;?>
					</div>
				</section>
			</div>