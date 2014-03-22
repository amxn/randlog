<?php $mts_options = get_option('sensational'); ?>
<?php get_header(); ?>
<div id="page">
	<?php if ($mts_options['mts_layout'] == 'cslayout' || $mts_options['mts_layout'] == 'sclayout') { ?>
	<?php } else { ?>
		<aside id="sidebar-left" class="left-menu">
			<?php if ( ! dynamic_sidebar( 'Left Sidebar' ) ) : ?>
			<?php endif ?>
		</aside>
	<?php } ?>
	<div class="article">
		<div id="content_box">
			<?php if (is_home() && !is_paged()) { ?>
				<?php if($mts_options['mts_featured_slider'] == '1') { ?>
					<div class="slider-container loading">
						<div class="flex-container">
							<div id="slider" class="flexslider">
								<ul class="slides">
									<?php $slider_cat = implode(",", $mts_options['mts_featured_slider_cat']); $my_query = new WP_Query('cat='.$slider_cat.'&posts_per_page=4');
										while ($my_query->have_posts()) : $my_query->the_post();
										$image_id = get_post_thumbnail_id();
										$image_url = wp_get_attachment_image_src($image_id,'related');
										$image_url = $image_url[0]; ?>
									<li data-thumb="<?php echo $image_url; ?>"> 
										<a href="<?php the_permalink() ?>">
											<?php the_post_thumbnail('slider',array('title' => '')); ?>
											<div class="flex-caption">
												<p class="slidertitle"><?php the_title(); ?></p>
											</div>
										</a> 
									</li>
									<?php endwhile; wp_reset_query(); ?>
								</ul>
							</div>
						</div>
					</div>
					<!-- slider-container -->
				<?php } ?>
			<?php } ?>		
				<?php $j = 0; if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } else { $paged = 1; }
				if($mts_options['mts_latest_section'] == '1') { 
					$latestsection = implode(",", $mts_options['mts_latest_section_cat']);
					query_posts('cat='.$latestsection.'&paged='.$paged);
				} else {
					query_posts( array( 'post_type' => 'post', 'paged' => $paged ) ); 
				}
				if (have_posts()) : while (have_posts()) : the_post();
				?>
				<article class="latestPost excerpt  <?php echo (++$j % 3 == 0) ? 'last' : ''; ?>">
					<header>
						<h2 class="title front-view-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						<?php if($mts_options['mts_home_headline_meta'] == '1') { ?>
							<div class="post-info">
								<span class="theauthor"><?php _e('By ','mythemeshop'); the_author_posts_link(); ?></span>  
								<span class="thetime updated"><i class="icon-calendar"></i> <?php the_time( get_option( 'date_format' ) ); ?></span>  
								<span class="thecategory"><i class="icon-tags"></i> <?php the_category(', ') ?></span>  
								<span class="thecomment"><i class="icon-comments"></i> <a rel="nofollow" href="<?php comments_link(); ?>"><?php echo comments_number();?></a></span>
							</div>
						<?php } ?>
					</header>
					<?php if ( has_post_thumbnail() ) { ?>
						<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow" id="featured-thumbnail">
								<?php echo '<div class="featured-thumbnail">'; the_post_thumbnail('featured',array('title' => '')); echo '</div>'; ?>
						</a>
					<?php } ?>
					<div class="front-view-content">
						<?php echo mts_excerpt(56);?>
					</div>
					<div class="readMore"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow"><?php _e('Read More...','mythemeshop'); ?></a></div>
				</article><!--.post excerpt-->
			<?php endwhile; endif; ?>
			<!--Start Pagination-->
			<?php if ($mts_options['mts_pagenavigation'] == '1' ) { ?>
				<?php  $additional_loop = 0; mts_pagination($additional_loop['max_num_pages']); ?>           
			<?php } else { ?>
				<div class="pagination pagination2">
					<ul>
						<li class="nav-previous"><?php next_posts_link( __( '&larr; '.'Older posts', 'mythemeshop' ) ); ?></li>
						<li class="nav-next"><?php previous_posts_link( __( 'Newer posts'.' &rarr;', 'mythemeshop' ) ); ?></li>
					</ul>
				</div>
			<?php } ?>
			<!--End Pagination-->
		</div><!--#content_box-->
	</div><!--.article-->
	<?php get_sidebar(); ?>
<?php get_footer(); ?>