			<div id="sidebar">
				<section id="opinions-sidebar" class="sidebar-section">
					<div class="s-section-title clearfix">
						<div class="s-title-background">
							<span class="s-title"><a href="https://www.tasc.it/opinioni">Opinioni</a></span>
						</div>
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
						<div class="s-title-background">
							<span class="s-title">Snacks</span>
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
				<div id="feedly-sidebar" class="sidebar-section">
					
				</div>
				<section id="other-sidebar" class="sidebar-section">
					<div class="s-section-title clearfix">
						<div class="s-title-background">
							<span class="s-title">Quotes</span>
						</div>
					</div>
				
					<div>
						<span class="quote">
							<?php
								$key = 'vyfl4dws0xnebf9ka95p9e'; 
								$language = 'it';
								$request = file_get_contents('https://www.getquotesapp.com/api/randomquote?key='.$key.'&ln='.$language);
								$response = json_decode($request, true);
								
								$body_quote = $response['quote']['body'];
								$author_quote = $response['quote']['author'];	
								echo '"' . $body_quote . '"';					
							?>
						</span>
						<span class="quote-author"><?php echo $author_quote ?></span>
					</div>
				</section>
				<section id="task-rank-sidebar" class="sidebar-section">
					<div id="tasc-world" class="promotion grafitestyle">
						<div class="s-section-title clearfix">
						<div class="s-title-background">
							<span class="s-title"><a href="http://www.tasc.it/tasc-rank">Tasc Rank</a></span>
						</div>
						</div>
											<div class="tascrank">
												<ul>
											    	<?php
											    	
													function cmp( $a, $b )
													{ 
													  if(  $a->points_user_day ==  $b->points_user_day ){ return 0 ; } 
													  return ($a->points_user_day < $b->points_user_day ) ? 1 : -1;
													} 
													
													$args = array(
													'meta_key' => 'points_user_day',
													'who' => 'authors',
													);
													$blogusers = get_users($args);
													usort($blogusers ,'cmp');
													$count = 0;
													foreach ($blogusers as $user) { $count++; ?>
													<li><a href="<?php echo get_author_posts_url( $user->ID ); ?>"><span class="avatar"><?php echo get_avatar($user->ID, 60); ?></span><span class="name"><?php echo $user->display_name; ?></span></a></li>						      
												    <?php 
												    if ($count==3) {break;}  }
												    ?>
												</ul>
											</div>
					</div>
					<div class="comewithus">
						SEI APPASSIONATO DI TENDENZE E INNOVAZIONE? TI PIACE SCRIVERE E VUOI DIRE LA TUA?
						<div class="entranelcast">Entra nel cast!<a class="divLink" alt="Entra nel cast!" title="Entra nel cast!" href="https://www.tasc.it/entra-nel-cast"></a></div>
					</div>	
					
				</section>
			</div>