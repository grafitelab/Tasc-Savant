								    	<?php 
											global $post;
											//get the right thumbnail
											$thumb_id = get_post_thumbnail_id();
											$thumb_url = wp_get_attachment_image_src($thumb_id,'thumb-big', true);
											$thumb= $thumb_url[0];
										?>
								    	<article class="article-big-story"  <?php if ( has_post_thumbnail() && get_post_type( $post ) == 'video') { ?>style="background-image:url('<?php echo $thumb; ?>'); background-size: cover;"  <?php } ?>>
								    	<div class="tasc-post">
								    		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
									    		<?php if ( get_post_type( $post ) == 'video'){ ?>
									    		<div class="video-icon"><div class="play"></div></div>
									    		<?php }?>
									    		<div class="title">
										    	<span class="category-highlight tag-<?php echo get_post_type( $post ) ?> tagformat-<?php echo get_post_format(); ?>"><span class="color"></span><?php
														$category = get_the_category(); 
														echo $category[0]->cat_name;?>
														<?php if(get_post_type( $post ) == 'video'){ $videocat = get_the_terms( $post->ID , 'video_category' );

														foreach ( $videocat as $lastTerm ) {
														
														echo $lastTerm->name;
														
														} }?><?php if(get_post_type( $post ) == 'column'){$columncat = get_the_terms( $post->ID , 'column_category' );
							
														foreach ( $columncat as $lastTerm ) {
														
														echo $lastTerm->name;
														
														} }?>
												</span><br/>
												<span class="title-date"><?php echo the_time('j F Y'); ?></span>
										    	<?php the_title(); ?>
										    	<div class="createdby">Creato da <?php $author = get_the_author(); echo $author; ?> </div></div>
								    			<div class="overlay"></div> 
								    			<?php if ( has_post_thumbnail() && get_post_type( $post ) != 'video' ) { the_post_thumbnail('large'); } elseif(!has_post_thumbnail() && get_post_type( $post ) == 'video' ) { ?><img style="visibility: hidden" src="<?php echo get_template_directory_uri(); ?>/library/images/default.jpg"/><?php } else{?><img style="visibility: hidden" src="<?php echo get_template_directory_uri(); ?>/library/images/default.jpg"/><?php } ?>
							    			<div class="gradient"></div>
								    		</a>
								    	</div>
								    	</article>
