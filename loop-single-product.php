<article id="post-<?php the_ID(); ?>" <?php if(is_single()) {post_class('clearfix single product');} else {post_class('clearfix snack');} ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							<?php get_template_part( 'parts/sharebox' ); ?>
						    <section class="post-content post-content-article clearfix" itemprop="articleBody">
							    <div class="leftColumn content">
									<?php the_content();?>
							    </div>
							    <div class="rightColumn details">
								    <a class="buyButton" href="#">Acquista</a>
							    </div>
							</section> <!-- end article section -->

<h1 class="mediumone single-section-title">Altri Prodotti</h1>

</article> <!-- end article -->
