<article id="post-<?php the_ID(); ?>" <?php if(is_single()) {post_class('clearfix single product');} else {post_class('clearfix snack');} ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							<?php get_template_part( 'parts/sharebox' ); ?>
						    <section class="post-content post-content-article clearfix" itemprop="articleBody">
							    <div class="rightColumn details">
								    <?php $productCustomMeta = get_post_meta($post->ID,'_my_meta',TRUE);?>
								    <span class="price"><?php if ($productCustomMeta['discounted-price'] != ""){ echo "<span class='discounted-price'>".$productCustomMeta['price'].'</span> | '.$productCustomMeta['discounted-price'];} else if ($productCustomMeta['price'] != "") { echo $productCustomMeta['price']; }?></span>
								    <span class="description">
								    	<h3>Descrizione:</h3>
								    	<?php if ($productCustomMeta['description'] != ""){ echo $productCustomMeta['description'];}?>
								    </span>
								    <a class="buyButton" href="#">Acquista</a>
							    </div>
							    <div class="leftColumn content">
									<?php the_content();?>
							    </div>
							</section> <!-- end article section -->

<h1 class="mediumone single-section-title">Altri Prodotti</h1>

</article> <!-- end article -->
