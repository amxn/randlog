<?php
$options = get_option('sensational');
if ( ! defined( 'ABSPATH' ) ) exit;
get_header('shop'); ?>
<div id="page" class="single">
	<?php if ($mts_options['mts_layout'] == 'cslayout' || $mts_options['mts_layout'] == 'sclayout') { ?>
	<?php } else { ?>
		<aside id="sidebar-left" class="left-menu">
			<?php if ( ! dynamic_sidebar( 'Left Sidebar' ) ) : ?>
			<?php endif ?>
		</aside>
	<?php } ?>
	<article class="article">
		<?php do_action('woocommerce_before_main_content'); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
			<?php endwhile; // end of the loop. ?>
		<?php do_action('woocommerce_after_main_content'); ?>
	</article>
	<?php get_sidebar('product'); ?>
<?php get_footer(); ?>