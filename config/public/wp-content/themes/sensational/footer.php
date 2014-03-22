<?php $mts_options = get_option('sensational'); ?>
	</div><!--.page-->
<footer>
	<div class="container">
		<div class="footer-widgets">
			<div class="f-widget f-widget-1">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1') ) : ?>
				<?php endif; ?>
			</div>
			<div class="f-widget f-widget-2">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 2') ) : ?>
				<?php endif; ?>
			</div>
			<div class="f-widget f-widget-3">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 3') ) : ?>
				<?php endif; ?>
			</div>
			<div class="f-widget f-widget-4 last">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 4') ) : ?>
				<?php endif; ?>
			</div>
			<div class="copyrights">
				<?php mts_copyrights_credit(); ?>
			</div> 
		</div><!--.footer-widgets-->
	</div><!--.container-->
</footer><!--footer-->
</div><!--.main-container-->
<?php mts_footer(); ?>
<?php wp_footer(); ?>
</body>
</html>