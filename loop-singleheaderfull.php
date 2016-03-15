					<?php 
						global $post;
						//get the right thumbnail
						$thumb_id = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src($thumb_id,'thumb-big', true);
						$thumb= $thumb_url[0];
					?>
					<div id="super-header">
						<div id="large-post-header" <?php if ( has_post_thumbnail() ) { ?>style="background-image:url('<?php echo $thumb; ?>');"  <?php } ?>  >
							<div id="full-post-info">
								<div id="super-title"><h1 class="single-title" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1></div>
								<div id="super-author">
									<h2>
										<span class="gravatar"><?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_email(), '120' ); } ?></span>
										<span class="author-details">creato da <?php the_author_posts_link(); ?> in <?php if(get_post_type( $post ) == 'video'){ $videocat = get_the_terms( $post->ID , 'video_category' );

														foreach ( $videocat as $lastTerm ) {
														
														echo $lastTerm->name;
														
														} }?><?php elseif(get_post_type( $post ) == 'column'){$columncat = get_the_terms( $post->ID , 'column_category' );
							
														foreach ( $columncat as $lastTerm ) {
														
														echo $lastTerm->name;
														
														} } else{
															$category = get_the_category(); 
														echo $category[0]->cat_name;
														}?></span>
									</h2>
								</div>
							</div>
			    			<div class="gradient"></div>
						</div>
					</div>