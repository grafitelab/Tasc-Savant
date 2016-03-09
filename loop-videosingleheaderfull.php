					<?php 
						global $post;
						//get the right thumbnail
						$thumb_id = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src($thumb_id,'thumb-big', true);
						$thumb= $thumb_url[0];
					?>
					
					<div id="super-header">
						<div id="large-post-header" <?php if ( has_post_thumbnail() ) { ?>style="background-image:url('<?php echo $thumb; ?>');"  <?php } ?>  >
							<h1 class="page-title"><?php
										$lastTerms = get_the_terms($post->ID, 'video_category' );
											if ($lastTerms && ! is_wp_error($lastTerms)) :
												$term_slugs_arr = array();
												foreach ($lastTerms as $term) {
													$term_slugs_arr[] = $term->slug;
												}
												$terms_slug_str = join( " ", $term_slugs_arr);
											endif;
											echo $terms_slug_str;
									?><div class="m-border"></div></h1>
							<div class="featured-last" <?php if ( has_post_thumbnail() ) { ?>style="background-image:url('<?php echo $thumb; ?>');"  <?php } ?>>
								<div class="m-slider-container">
									
									<div class="arrow arrow-left"><div class="inner-arrow"></div><div class="arrow-text">Previous</div><a class="divLink" rel="previous" href="#"></a></div>
									<div class="arrow arrow-right"><div class="inner-arrow"></div><div class="arrow-text">Next</div><a class="divLink" rel="next" href="#"></a></div>
								</div>
								<?php if( has_post_video() ) {the_post_video();} ?>
							</div>
							
							<div id="full-post-info">
								<div id="super-title"><h1 class="single-title" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1></div>
							</div>
			    			<div class="featured-background-shade"></div>
						</div>
					</div>