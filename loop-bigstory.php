								    	<article class="article-big-story">
								    	<div class="tasc-post">
								    		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
									    		<div class="title">
										    	<span class="category-highlight tag-<?php echo get_post_type( $post ) ?> tagformat-<?php echo get_post_format(); ?>"><span class="color"></span><?php
														$category = get_the_category(); 
														echo $category[0]->cat_name;?>
												</span><br/>
												<span class="title-date"><?php echo the_time('j F Y'); ?></span>
										    	<?php the_title(); ?>
										    	<div class="createdby">Creato da <?php $author = get_the_author(); echo $author; ?> </div></div>
								    			<div class="overlay"></div> 
								    			<?php if ( has_post_thumbnail() ) { the_post_thumbnail('large'); } else { ?><img src="<?php echo get_template_directory_uri(); ?>/library/images/default.jpg" /><?php } ?>
							    			<div class="gradient"></div>
								    		</a>
								    	</div>
								    	</article>
