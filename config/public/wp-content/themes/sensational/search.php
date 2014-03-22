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
			<h1 class="postsby">
				<span><?php _e("Search Results for:", "mythemeshop"); ?></span> <?php the_search_query(); ?>
			</h1>
			<?php $j = 0; if (have_posts()) : while (have_posts()) : the_post(); ?>
				<article class="latestPost excerpt  <?php echo (++$j % 3 == 0) ? 'last' : ''; ?>">
					<header>
						<h2 class="title front-view-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						<?php if($mts_options['mts_home_headline_meta'] == '1') { ?>
							<div class="post-info">
								<span class="theauthor"><i class="icon-user"></i> <?php  the_author_posts_link(); ?></span>  
								<span class="thetime"><i class="icon-calendar"></i> <?php the_time( get_option( 'date_format' ) ); ?></span>  
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
						<?php echo mts_excerpt(29);?>
					</div>
					<div class="readMore"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow"><?php _e('Read More','mythemeshop'); ?></a></div>
				</article><!--.post excerpt-->
			<?php endwhile; else: ?>
				<div class="no-results">
					<h2><?php _e('We apologize for any inconvenience, please hit back on your browser or use the search form below.', 'mythemeshop'); ?></h2>
					<?php get_search_form(); ?>
				</div><!--noResults-->
			<?php endif; ?>
			<!--Start Pagination-->
			<?php if ($mts_options['mts_pagenavigation'] == '1' ) { ?>
				<?php  $additional_loop = 0; mts_pagination($additional_loop['max_num_pages']); ?>           
			<?php } else { ?>
				<div class="pagination">
					<ul>
						<li class="nav-previous"><?php next_posts_link( __( '&larr; '.'Older posts', 'mythemeshop' ) ); ?></li>
						<li class="nav-next"><?php previous_posts_link( __( 'Newer posts'.' &rarr;', 'mythemeshop' ) ); ?></li>
					</ul>
				</div>
			<?php } ?>
			<!--End Pagination-->
		</div>
	</div>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>