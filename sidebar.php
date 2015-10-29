			<div id="sidebar">
				<section id="opinions-sidebar" class="sidebar-section">
					<div class="s-section-title clearfix">
						<div class="s-title-border"></div>
						<div class="s-title-background">
							<span class="s-title">Le vostre opinioni</span>
							<div class="s-title-white-triangle"></div>
						</div>
						<a href="#">Tutte le opinioni ></a>
					</div>
					<div>
								<?php 
									$sidebar_opinions = new WP_Query( array( 'post_type' => 'opinion', 'showposts' => 3 )  );
									while ( $sidebar_opinions->have_posts() ) : $sidebar_opinions->the_post(); 
								?>
								<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix main-post permalink'); ?> role="article">
								<?php if ( has_post_thumbnail() ) { the_post_thumbnail('large'); } else { ?><img src="<?php echo get_template_directory_uri(); ?>/library/images/default.jpg" /><?php } ?>
								<span class="s-opinion-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></span>
								<div class="createdby">Creato da <?php $author = get_the_author(); echo $author; ?></div>	
								</article>
								<?php endwhile; ?>
					</div>
				</section>
				<section id="snacks-sidebar" class="sidebar-section">
					<div class="s-section-title clearfix">
						<div class="s-title-border"></div>
						<div class="s-title-background">
							<span class="s-title">Snacks</span>
							<div class="s-title-white-triangle"></div>
						</div>
						<a href="#">Tutti gli snacks ></a>	
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
										<ul class="s-column-container">
												<?php foreach ( $terms as $term ) { ?>
											<li class="s-column-single">
												<div class="outer-mask">
													<div class="inner-mask">
														<div class="content"><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?></a></div>
        											</div>
    											</div>
    										</li>
												<?php } ?>
    									</ul>
    									
									<?php endif;?>
					</div>
				</section>
				<div id="feedly-sidebar" class="sidebar-section">
					
				</div>
				<section id="other-sidebar" class="sidebar-section">
					<div class="s-section-title clearfix">
						<div class="s-title-border"></div>
						<div class="s-title-background">
							<span class="s-title">Quotes</span>
							<div class="s-title-white-triangle"></div>
						</div>
						<a href="#">Scarica Quotes ></a>
					</div>
					<div style="width: 100%;height: 300px;border: 1px solid;box-sizing: border-box;">
						<span class="quote">
				
						</span>
						<span class="quote-author"></span>
						<span><a href="#">Scarica quotes dall'app store ></a></span>
					</div>
				</section>
				<section id="task-rank-sidebar" class="sidebar-section">
					
				</section>
			</div>