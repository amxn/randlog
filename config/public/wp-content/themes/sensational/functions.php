<?php
/*-----------------------------------------------------------------------------------*/
/*	Do not remove these lines, sky will fall on your head.
/*-----------------------------------------------------------------------------------*/
require_once( dirname( __FILE__ ) . '/theme-options.php' );
include("functions/tinymce/tinymce.php");
if ( ! isset( $content_width ) ) $content_width = 1202;

/*-----------------------------------------------------------------------------------*/
/*	Load Translation Text Domain
/*-----------------------------------------------------------------------------------*/
load_theme_textdomain( 'mythemeshop', get_template_directory().'/lang' );
if ( function_exists('add_theme_support') ) add_theme_support('automatic-feed-links');

/*-----------------------------------------------------------------------------------*/
/*	Post Thumbnail Support
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 200, 200, true );
	add_image_size( 'featured', 200, 200, true ); //Featured
	add_image_size( 'related', 180, 120, true ); //related
	add_image_size( 'widgetthumb', 50, 50, true ); //widget
	add_image_size( 'slider', 600, 200, true ); //slider
}

/*-----------------------------------------------------------------------------------*/
/*	Custom Menu Support
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'menus' );
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'primary-menu' => 'Primary Menu'
		)
	);
}

/*-----------------------------------------------------------------------------------*/
/*	Javascsript
/*-----------------------------------------------------------------------------------*/
function mts_add_scripts() {
	$mts_options = get_option('sensational');

	wp_enqueue_script('jquery');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_register_script('customscript', get_template_directory_uri() . '/js/customscript.js');
	wp_enqueue_script ('customscript');

	//Slider
	if($mts_options['mts_featured_slider'] == '1' && !is_singular()) {
		wp_register_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js');
		wp_enqueue_script ('flexslider');
	}	

	global $is_IE;
    if ($is_IE) {
        wp_register_script ('html5shim', "http://html5shim.googlecode.com/svn/trunk/html5.js");
        wp_enqueue_script ('html5shim');
	}
}
add_action('wp_enqueue_scripts','mts_add_scripts');
   
function mts_load_footer_scripts() {  
	$mts_options = get_option('sensational');
	
	// Site wide js
	wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.min.js', true);
	wp_enqueue_script ('modernizr');
	
	//Lightbox
	if($mts_options['mts_lightbox'] == '1') {
		wp_register_script('prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', true);
		wp_enqueue_script('prettyPhoto');
	}

	//Sticky Nav
	if($mts_options['mts_floating_header'] == '1') {
		wp_register_script('StickyNav', get_template_directory_uri() . '/js/sticky.js', true);
		wp_enqueue_script('StickyNav');;
	}
}  
add_action('wp_footer', 'mts_load_footer_scripts');  

/*-----------------------------------------------------------------------------------*/
/* Enqueue CSS
/*-----------------------------------------------------------------------------------*/
function mts_enqueue_css() {
	$mts_options = get_option('sensational');
	//slider
	if($mts_options['mts_featured_slider'] == '1' && !is_singular()) {
		wp_register_style('flexslider', get_template_directory_uri() . '/css/flexslider.css', 'style');
		wp_enqueue_style('flexslider');
	}

	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		//WooCommerce
		wp_register_style('woocommerce', get_template_directory_uri() . '/css/woocommerce2.css', 'style');
		wp_enqueue_style('woocommerce');
	}
	
	//lightbox
	if($mts_options['mts_lightbox'] == '1') {
		wp_register_style('prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css', 'style');
		wp_enqueue_style('prettyPhoto');
	}
	
	//Font Awesome
	wp_register_style('fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', 'style');
	wp_enqueue_style('fontawesome');
	global $is_IE;
    if ($is_IE) {
       wp_register_style('ie7-fontawesome', get_template_directory_uri() . '/css/font-awesome-ie7.min.css', 'style');
	   wp_enqueue_style('ie7-fontawesome');
	}
	
	wp_enqueue_style('stylesheet', get_template_directory_uri() . '/style.css', 'style');

	//Responsive
	if($mts_options['mts_responsive'] == '1') {
        wp_enqueue_style('responsive', get_stylesheet_directory_uri() . '/css/responsive.css', 'style');
	}
	
	if ($mts_options['mts_bg_pattern_upload'] != '') {
		$mts_bg = $mts_options['mts_bg_pattern_upload'];
	} else {
		if($mts_options['mts_bg_pattern'] != '') {
			$mts_bg = get_template_directory_uri().'/images/'.$mts_options['mts_bg_pattern'].'.png';
		} 
	}
	$mts_cslayout = '';
	$mts_sclayout = '';
	$mts_shareit_left = '';
	$mts_scclayout = '';
	$mts_2col = '';
	$mts_image_border = '';
	$mts_float_header = '';
	$mts_page_border = '';
	$mts_author = '';
	$mts_header_section = '';
	$mts_left_sidebar_title = '';
	if($mts_options['mts_floating_social'] == '1') {
		if($mts_options['mts_layout'] == 'scslayout') {
			$mts_shareit_left = '.shareit { background: #fff; top: 282px; left: auto; z-index: 0; margin: 0 0 0 -295px; width: 90px; position: fixed; padding: 5px; border:1px solid #EEE; border-right: 0;} .share-item {margin: 2px;}}';
		} elseif($mts_options['mts_layout'] == 'scclayout') {
			$mts_shareit_left = '.shareit { background: #fff; top: 282px; left: auto; z-index: 0; margin: 0 0 0 821px; width: 90px; position: fixed; padding: 5px; border:1px solid #EEE; border-left: 0;} .share-item {margin: 2px;}}';
		} elseif($mts_options['mts_layout'] == 'sclayout') {
			$mts_shareit_left = '.shareit { background: #fff; top: 282px!important; left: auto!important; z-index: 0; margin: 0 0 0 651px!important; width: 90px!important; position: fixed!important; padding: 5px!important; border:1px solid #EEE!important; border-left: 0!important;} .share-item {margin: 2px;}
				@media screen and (max-width:1210px) { 
    				.shareit { position: relative!important; width: 100%!important; top: 0!important; padding-left: 0!important; padding-right: 0!important; margin: 0!important; padding-top: 0!important; border: none!important; }
				}';
		} elseif($mts_options['mts_layout'] == 'cslayout') {
			$mts_shareit_left = '.shareit { background: #fff; top: 282px!important; left: auto!important; z-index: 0; margin: 0 0 0 -120px!important; width: 90px!important; position: fixed!important; padding: 5px!important; border:1px solid #EEE!important; border-right: 0!important;} .share-item {margin: 2px;}
				@media screen and (max-width:1210px) { 
    				.shareit { position: relative!important; width: 100%!important; top: 0!important; padding-left: 0!important; padding-right: 0!important; margin: 0!important; padding-top: 0!important; border: none!important; }
				}';
		}
	}
	if ($mts_options['mts_layout'] == 'cslayout' || $mts_options['mts_layout'] == 'sclayout') {
		$mts_2col = '#page, .container {width: 1008px;}
		.flexslider, .latestPost { margin-right: 0; width: 100%; } .woocommerce div.product div.summary, .woocommerce-page div.product div.summary, .woocommerce #content div.product div.summary, .woocommerce-page #content div.product div.summary { width: 48%; padding-right: 0;} .woocommerce div.product .woocommerce-tabs, .woocommerce-page div.product .woocommerce-tabs, .woocommerce #content div.product .woocommerce-tabs, .woocommerce-page #content div.product .woocommerce-tabs, .woocommerce .related ul.products, .woocommerce-page .related ul.products, .woocommerce .upsells.products ul.products, .woocommerce-page .upsells.products ul.products, .woocommerce .related ul, .woocommerce-page .related ul, .woocommerce .upsells.products ul, .woocommerce-page .upsells.products ul { width: 100%; } .related-posts, .postauthor, #comments, #commentsAdd { width: 100%; margin-right: 0; margin-left: 0; } .single_post, .single_page { padding-right: 0; width: 100%; }';
	}
	if ($mts_options['mts_layout'] == 'cslayout') {
		$mts_cslayout = '.article { padding: 0 2%; width: 62.5%; }
		.sidebar.c-4-12 { width: 29%; }';
	}
	if ($mts_options['mts_layout'] == 'sclayout') {
		$mts_sclayout = '.article { float: right; padding: 0 2%; width: 62.5%; border-right: 0; border-left: 1px #F2F2F2 solid; } .sidebar.c-4-12 { float: left; padding-right: 2.2%; width: 29%; }';
	}
	if ($mts_options['mts_layout'] == 'scclayout') {
		$mts_scclayout = '.article {border-left: 1px solid #F2F2F2; border-right: 0; float: right; } .latestPost { padding: 20px 0 40px 0; margin-left: 4%; margin-right: 0; }
		#sidebar-left {float: right; margin: 30px 14px 0 2%; } .left-menu li { text-align: left; } .left-menu .widget li, .woocommerce .single #content { margin-left: 0; } .single_post { padding: 20px 0 0 3%} .related-posts, .postauthor, #comments, #commentsAdd { margin-right: 0; margin-left: 3%; } .woocommerce #content { margin-left: 4%; }
		.left-menu .tagcloud a { float: left; margin-left: 0; margin-right: 5px }.sidebar.c-4-12 { float: left; } .flexslider { margin: 28px 0 0 4%; } .woocommerce div.product div.images, .woocommerce-page div.product div.images, .woocommerce #content div.product div.images, .woocommerce-page #content div.product div.images { width: 48%; padding-left: 0; }
		.woocommerce span.onsale, .woocommerce-page span.onsale { left: 2% !important }
		.woocommerce .woocommerce-breadcrumb, .woocommerce-page .woocommerce-breadcrumb { padding-left: 2% }
		.woocommerce div.product .woocommerce-tabs .panel, .woocommerce-page div.product .woocommerce-tabs .panel, .woocommerce #content div.product .woocommerce-tabs .panel, .woocommerce-page #content div.product .woocommerce-tabs .panel { padding-left: 2% }
		.woocommerce .related h2 { padding-left: 2% }
		';
	}
	if($mts_options['mts_author_comment'] == '1') {
		$mts_author = '.bypostauthor {padding: 3%!important; background: #FAFAFA; width: 94%!important;}
		.bypostauthor .fn:after { content: "'.__('Author','mythemeshop').'"; position: absolute; margin-left: 10px; top: 1px; padding: 1px 10px; background: #818181; color: #FFF; }';
	}
	if ($mts_options['mts_floating_header'] == '1') {
		$mts_float_header = '.main-header { border-bottom: 1px solid #EEEEEE; left: 0; opacity: 0.9; position: fixed; top: 0; z-index: 50;}
		#content_area {margin-top: 45px; }';
	}
	if ($mts_options['mts_bg_pattern_upload'] != '' || $mts_options['mts_bg_pattern'] != 'nobg' || $mts_options['mts_bg_color'] != '#ffffff') {
		$mts_page_border = '#page { border: 1px solid #EEE } #content_area { padding-top: 20px; } footer { margin-top: 20px; }';
	}
	if ($mts_options['mts_left_sidebar_title'] == '1') {
		$mts_left_sidebar_title = '.left-menu h3 { display: block; }';
	}
	if ($mts_options['mts_image_border'] == '1') {
		$mts_image_border = '.article img.left, .article img.alignleft, .wp-caption.alignleft, .article img.right, .article img.alignright, .wp-caption.alignright,
		.article img.center, .article img.aligncenter, .wp-caption.aligncenter, .article img.alignnone { background: #fff; border: 1px solid #d3d3d3; padding: 5px;
		max-width: 98%; -webkit-border-radius: 4px; -moz-border-radius: 4px; -o-border-radius: 4px; -ms-border-radius: 4px; -khtml-border-radius: 4px;
		border-radius: 4px; }
		.article img.left:hover, .article img.alignleft:hover, .wp-caption.alignlef:hover, article img.right:hover, .article img.alignright:hover,
		.wp-caption.alignright:hover, .article img.center:hover, .article img.aligncenter:hover, .wp-caption.aligncenter:hover, .article img.alignnone:hover {
		background: #dbd9da; border-color: #bcbcbc } ';
	}
	$custom_css = "
		body {background-color:{$mts_options['mts_bg_color']}; }
		body {background-image: url({$mts_bg});}
		a:hover, .menu a:hover, #navigation .menu [class^='icon-']:hover:before , .woocommerce .woocommerce-breadcrumb a, .woocommerce-page .woocommerce-breadcrumb a, .menu li.sfHover > a.sf-with-ul { color:{$mts_options['mts_primary_color']}; }
		.left-menu li a, .left-menu li .menu a, .reply a { background: {$mts_options['mts_primary_color']}; }
		.textwidget a, .pagination a, .related-posts a:hover, .comm, .single .pagination a .currenttext, a { color:{$mts_options['mts_secondary_color']}; }	
		.pagination .nav-previous a, .pagination .nav-next a, #commentform input#submit, .contactform #submit, .mts-subscribe input[type='submit'], #move-to-top:hover, .currenttext, .pagination a:hover, .woocommerce a.button, .woocommerce-page a.button, .woocommerce button.button, .woocommerce-page button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce #respond input#submit, .woocommerce-page #respond input#submit, .woocommerce #content input.button, .woocommerce-page #content input.button, .readMore a, .woocommerce a.button, .woocommerce-page a.button, .woocommerce button.button, .woocommerce-page button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce #respond input#submit, .woocommerce-page #respond input#submit, .woocommerce #content input.button, .woocommerce-page #content input.button, .current-menu-item:after, .tagcloud a, .tags a { background:{$mts_options['mts_secondary_color']}; color: #fff; }
		.latestPost, .postauthor, #comments, #searchform:hover, .mts-subscribe input[type='text']:hover, input#author:hover, input#email:hover, input#url:hover, #comment:hover { border-color: {$mts_options['mts_secondary_color']}; }
		{$mts_cslayout}
		{$mts_sclayout}
		{$mts_scclayout}
		{$mts_2col}
		{$mts_author}
		{$mts_author}
		{$mts_header_section}
		{$mts_shareit_left}
		{$mts_float_header}
		{$mts_left_sidebar_title}
		{$mts_image_border}
		{$mts_page_border}
		{$mts_options['mts_custom_css']}
			";
	wp_add_inline_style( 'stylesheet', $custom_css );
}
add_action('wp_enqueue_scripts', 'mts_enqueue_css', 99);

/*-----------------------------------------------------------------------------------*/
/*	Enable Widgetized sidebar and Footer
/*-----------------------------------------------------------------------------------*/
if ( function_exists('register_sidebar') )
	//Left Sidebar Widget
	register_sidebar(array('name'=>'Left Sidebar',
		'description' => __('This Widget area can be used for category widget or 125px Ad.', 'mythemeshop'),
		'before_widget' => '<li class="widget widget-sidebar">',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	
	// Sidebar Widget
	register_sidebar(array('name'=>'Sidebar',
		'before_widget' => '<li class="widget widget-sidebar">',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	
	// Footer Widgets
	$sidebars = array(1, 2, 3, 4);
	foreach($sidebars as $number) {
	register_sidebar(array(
		'name' => 'Footer ' . $number,
		'id' => 'footer-' . $number,
		'before_widget' => '<div class="footer_widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	}

/*-----------------------------------------------------------------------------------*/
/*  Load Widgets & Shortcodes
/*-----------------------------------------------------------------------------------*/
// Add the 125x125 Ad Block Custom Widget
include("functions/widget-ad125.php");

// Add the 300x250 Ad Block Custom Widget
include("functions/widget-ad300.php");

// Add the Tabbed Custom Widget
include("functions/widget-tabs.php");

// Add the Latest Tweets Custom Widget
include("functions/widget-tweets.php");

// Add the Theme Shortcodes
include("functions/theme-shortcodes.php");

// Add Recent Posts Widget
include("functions/widget-recentposts.php");

// Add Related Posts Widget
include("functions/widget-relatedposts.php");

// Add Popular Posts Widget
include("functions/widget-popular.php");

// Add Facebook Like box Widget
include("functions/widget-fblikebox.php");

// Add Google Plus box Widget
include("functions/widget-googleplus.php");

// Add Subscribe Widget
include("functions/widget-subscribe.php");

// Add Social Profile Widget
include("functions/widget-social.php");

// Add Category Posts Widget
include("functions/widget-catposts.php");

// Add Welcome message
include("functions/welcome-message.php");

// Theme Functions
include("functions/theme-actions.php");

if($mts_options['mts_theme_update'] == '1') {
// Update Notification
include("functions/update_notifier.php");
}

/*-----------------------------------------------------------------------------------*/
/*	Filters customize wp_title
/*-----------------------------------------------------------------------------------*/
function mts_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'mythemeshop' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'mts_wp_title', 10, 2 );

/*-----------------------------------------------------------------------------------*/
/*	Thumbnail Quality
/*-----------------------------------------------------------------------------------*/
if(isset($mts_options['mts_thumb_quality_on']) == '1') {
	function thumbnail_quality( $quality ) {
		$mts_options = get_option('sensational');
	    return $mts_options['mts_thumb_quality'];
	}
	add_filter( 'jpeg_quality', 'thumbnail_quality' );
	add_filter( 'wp_editor_set_quality', 'thumbnail_quality' );
}

/*-----------------------------------------------------------------------------------*/
/*	Filters that allow shortcodes in Text Widgets
/*-----------------------------------------------------------------------------------*/
add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');
add_filter('the_content_rss', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	Custom Comments template
/*-----------------------------------------------------------------------------------*/
function mts_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" style="position:relative;">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment->comment_author_email, 50 ); ?>
				<?php printf(__('<span class="fn">%s</span>', 'mythemeshop'), get_comment_author_link()) ?> 
				<?php $mts_options = get_option('sensational'); if($mts_options['mts_comment_date'] == '1') { ?>
					<span class="ago"><?php comment_date( get_option( 'date_format' ) ); ?></span>
				<?php } ?>
				<span class="comment-meta">
					<?php edit_comment_link(__('(Edit)', 'mythemeshop'),'  ','') ?>
				</span>
			</div>
			<?php if ($comment->comment_approved == '0') : ?>
				<em><?php _e('Your comment is awaiting moderation.', 'mythemeshop') ?></em>
				<br />
			<?php endif; ?>
			<div class="commentmetadata">
			<?php comment_text() ?>
            <div class="reply">
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>
			</div>
		</div>
<?php }

/*-----------------------------------------------------------------------------------*/
/*	excerpt
/*-----------------------------------------------------------------------------------*/
function mts_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt);
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

/*-----------------------------------------------------------------------------------*/
/* nofollow to next/previous links
/*-----------------------------------------------------------------------------------*/
function mts_pagination_add_nofollow($content) {
    return 'rel="nofollow"';
}
add_filter('next_posts_link_attributes', 'mts_pagination_add_nofollow' );
add_filter('previous_posts_link_attributes', 'mts_pagination_add_nofollow' );

/*-----------------------------------------------------------------------------------*/
/* Nofollow to category links
/*-----------------------------------------------------------------------------------*/
add_filter( 'the_category', 'mts_add_nofollow_cat' ); 
function mts_add_nofollow_cat( $text ) {
$text = str_replace('rel="category tag"', 'rel="nofollow"', $text); return $text;
}

/*-----------------------------------------------------------------------------------*/	
/* nofollow post author link
/*-----------------------------------------------------------------------------------*/
add_filter('the_author_posts_link', 'mts_nofollow_the_author_posts_link');
function mts_nofollow_the_author_posts_link ($link) {
return str_replace('<a href=', '<a rel="nofollow" href=',$link); 
}

/*-----------------------------------------------------------------------------------*/	
/* nofollow to reply links
/*-----------------------------------------------------------------------------------*/
function mts_add_nofollow_to_reply_link( $link ) {
return str_replace( '")\'>', '")\' rel=\'nofollow\'>', $link );
}
add_filter( 'comment_reply_link', 'mts_add_nofollow_to_reply_link' );
	
/*-----------------------------------------------------------------------------------*/
/* removes the WordPress version from your header for security
/*-----------------------------------------------------------------------------------*/
function wb_remove_version() {
	return '<!--Theme by MyThemeShop.com-->';
}
add_filter('the_generator', 'wb_remove_version');
	
/*-----------------------------------------------------------------------------------*/
/* Removes Trackbacks from the comment count
/*-----------------------------------------------------------------------------------*/
add_filter('get_comments_number', 'mts_comment_count', 0);
function mts_comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
		return count($comments_by_type['comment']);
	} else {
		return $count;
	}
}

/*-----------------------------------------------------------------------------------*/
/* adds a class to the post if there is a thumbnail
/*-----------------------------------------------------------------------------------*/
function has_thumb_class($classes) {
	global $post;
	if( has_post_thumbnail($post->ID) ) { $classes[] = 'has_thumb'; }
		return $classes;
}
add_filter('post_class', 'has_thumb_class');

/*-----------------------------------------------------------------------------------*/	
/* Breadcrumb
/*-----------------------------------------------------------------------------------*/
function mts_the_breadcrumb() {
	echo '<a href="';
	echo home_url();
	echo '" rel="nofollow"><i class="icon-home"></i>&nbsp;'.__('Home','mythemeshop');
	echo "</a>";
	if (is_category() || is_single()) {
		echo "&nbsp;/&nbsp;";
		the_category(' &bull; ');
			if (is_single()) {
				echo "&nbsp;/&nbsp;";
				the_title();
			}
	} elseif (is_page()) {
		echo "&nbsp;/&nbsp;";
		echo the_title();
	} elseif (is_search()) {
		echo "&nbsp;/&nbsp;".__('Search Results for','mythemeshop')."... ";
		echo '"<em>';
		echo the_search_query();
		echo '</em>"';
	}
}

/*-----------------------------------------------------------------------------------*/	
/* Pagination
/*-----------------------------------------------------------------------------------*/
function mts_pagination($pages = '', $range = 3) { 
	$showitems = ($range * 3)+1;
	global $paged; if(empty($paged)) $paged = 1;
	if($pages == '') {
		global $wp_query; $pages = $wp_query->max_num_pages; 
		if(!$pages){ $pages = 1; } 
	}
	if(1 != $pages) { 
		echo "<div class='pagination'><ul>";
		if($paged > 2 && $paged > $range+1 && $showitems < $pages) 
			echo "<li><a rel='nofollow' href='".get_pagenum_link(1)."'>&laquo; ".__('First','mythemeshop')."</a></li>";
		if($paged > 1 && $showitems < $pages) 
			echo "<li><a rel='nofollow' href='".get_pagenum_link($paged - 1)."' class='inactive'>&lsaquo; ".__('Previous','mythemeshop')."</a></li>";
		for ($i=1; $i <= $pages; $i++){ 
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) { 
				echo ($paged == $i)? "<li class='current'><span class='currenttext'>".$i."</span></li>":"<li><a rel='nofollow' href='".get_pagenum_link($i)."' class='inactive'>".$i."</a></li>";
			} 
		} 
		if ($paged < $pages && $showitems < $pages) 
			echo "<li><a rel='nofollow' href='".get_pagenum_link($paged + 1)."' class='inactive'>".__('Next','mythemeshop')." &rsaquo;</a></li>";
		if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) 
			echo "<li><a rel='nofollow' class='inactive' href='".get_pagenum_link($pages)."'>".__('Last','mythemeshop')." &raquo;</a></li>";
			echo "</ul></div>"; 
	}
}

/*-----------------------------------------------------------------------------------*/
/* Redirect feed to feedburner
/*-----------------------------------------------------------------------------------*/
$mts_options = get_option('sensational');
if ( isset($mts_options['mts_feedburner']) != '') {
function mts_rss_feed_redirect() {
    $mts_options = get_option('sensational');
    global $feed;
    $new_feed = $mts_options['mts_feedburner'];
    if (!is_feed()) {
            return;
    }
    if (preg_match('/feedburner/i', $_SERVER['HTTP_USER_AGENT'])){
            return;
    }
    if ($feed != 'comments-rss2') {
            if (function_exists('status_header')) status_header( 302 );
            header("Location:" . $new_feed);
            header("HTTP/1.1 302 Temporary Redirect");
            exit();
    }
}
add_action('template_redirect', 'mts_rss_feed_redirect');
}

$mts_options = get_option('sensational');
if ( $mts_options['mts_admin_style'] == '1') {
function mts_admin_css() {
	wp_enqueue_style( 'mts_admin_css', get_template_directory_uri() . '/css/admin.css' );
}
add_action('admin_print_styles', 'mts_admin_css' );
function mts_remove_footer_admin () {
    echo "Thank you for creating with <a href=\"http://wordpress.org/\">WordPress</a>. Dashboard Customization by <a href=\"http://mythemeshop.com/\">MyThemeShop</a>.";
} 
add_filter('admin_footer_text', 'mts_remove_footer_admin');
}

/*-----------------------------------------------------------------------------------*/
/* Single Post Pagination
/*-----------------------------------------------------------------------------------*/
function mts_wp_link_pages_args_prevnext_add($args)
{
    global $page, $numpages, $more, $pagenow;
    if (!$args['next_or_number'] == 'next_and_number')
        return $args; 
    $args['next_or_number'] = 'number'; 
    if (!$more)
        return $args; 
    if($page-1) 
        $args['before'] .= _wp_link_page($page-1)
        . $args['link_before']. $args['previouspagelink'] . $args['link_after'] . '</a>'
    ;
    if ($page<$numpages) 
    
        $args['after'] = _wp_link_page($page+1)
        . $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>'
        . $args['after']
    ;
    return $args;
}
add_filter('wp_link_pages_args', 'mts_wp_link_pages_args_prevnext_add');

/*-----------------------------------------------------------------------------------*/
/* WooCommerce
/*-----------------------------------------------------------------------------------*/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
add_theme_support('woocommerce');

// Register Shop and Single Product Sidebar
register_sidebar(array(
	'name' => 'Shop Page Sidebar',
	'description'   => __( 'Appears on Shop main page and product archive pages.', 'mythemeshop' ),
	'id' => 'shop-sidebar',
	'before_widget' => '<li id="%1$s" class="widget widget-sidebar %2$s">',
	'after_widget' => '</li>',
	'before_title' => '<div class="widget-wrap"><h3>',
	'after_title' => '</h3></div>',
));
register_sidebar(array(
	'name' => 'Single Product Sidebar',
	'description'   => __( 'Appears on single product pages.', 'mythemeshop' ),
	'id' => 'product-sidebar',
	'before_widget' => '<li id="%1$s" class="widget widget-sidebar %2$s">',
	'after_widget' => '</li>',
	'before_title' => '<div class="widget-wrap"><h3>',
	'after_title' => '</h3></div>',
));

// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

// Redefine woocommerce_output_related_products()
function woocommerce_output_related_products() {
woocommerce_related_products(3,1); // Display 3 products in rows of 1
}

/*** Hook in on activation */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'mythemeshop_woocommerce_image_dimensions', 1 );
 
/*** Define image sizes */
function mythemeshop_woocommerce_image_dimensions() {
  	$catalog = array(
		'width' 	=> '195',	// px
		'height'	=> '195',	// px
		'crop'		=> 1 		// true
	);
	$single = array(
		'width' 	=> '314',	// px
		'height'	=> '314',	// px
		'crop'		=> 1 		// true
	);
	$thumbnail = array(
		'width' 	=> '72',	// px
		'height'	=> '72',	// px
		'crop'		=> 1 		// false
	); 
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

add_filter ( 'woocommerce_product_thumbnails_columns', 'xx_thumb_cols' );
 function xx_thumb_cols() {
     return 4; // .last class applied to every 4th thumbnail
 }
}

// Display 24 products per page. Goes in functions.php
$mts_home_producst = $mts_options['mts_shop_products'];
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$mts_home_producst.';' ), 20 );

/*------------[ Cart ]-------------*/
if ( ! function_exists( 'mts_cart' ) ) {
	function mts_cart() { 
	global $mts_options;
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
?>
<div class="mts-cart">
	<?php global $woocommerce; ?>
	<span>
		<i class="icon-user"></i> 
		<?php if ( is_user_logged_in() ) { ?>
			<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','mythemeshop'); ?>"><?php _e('My Account','mythemeshop'); ?></a>
		<?php } 
		else { ?>
			<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','mythemeshop'); ?>"><?php _e('Login ','mythemeshop'); ?></a>
		<?php } ?>
	</span>
	<span>
		<i class="icon-shopping-cart"></i> <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'mythemeshop'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'mythemeshop'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	</span>
</div>
<?php } }

// Ensure cart contents update when products are added to the cart via AJAX
add_filter('add_to_cart_fragments', 'mts_header_add_to_cart_fragment');
 
function mts_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();	?>
	
	<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'mythemeshop'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'mythemeshop'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	
	<?php $fragments['a.cart-contents'] = ob_get_clean();
	return $fragments;
}
}

/*-----------------------------------------------------------------------------------*/
/* add <!-- next-page --> button to tinymce
/*-----------------------------------------------------------------------------------*/
add_filter('mce_buttons','wysiwyg_editor');
function wysiwyg_editor($mce_buttons) {
   $pos = array_search('wp_more',$mce_buttons,true);
   if ($pos !== false) {
       $tmp_buttons = array_slice($mce_buttons, 0, $pos+1);
       $tmp_buttons[] = 'wp_page';
       $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos+1));
   }
   return $mce_buttons;
}

/*-----------------------------------------------------------------------------------*/
/*	Custom Gravatar Support
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'mts_custom_gravatar' ) ) {
    function mts_custom_gravatar( $avatar_defaults ) {
        $mts_avatar = get_bloginfo('template_directory') . '/images/gravatar.png';
        $avatar_defaults[$mts_avatar] = 'Custom Gravatar (/images/gravatar.png)';
        return $avatar_defaults;
    }
    add_filter( 'avatar_defaults', 'mts_custom_gravatar' );
}

/*----------------------------------------------------
/* Sticky Sidebar
/*---------------------------------------------------*/
function mts_sticky_sidebar() {
global $mts_options;
if($mts_options['mts_floating_leftside'] == '1') { ?>
	<script type="text/javascript">
 jQuery(window).scroll(function() {
        jQuery('#sidebar-left').animate({ top: jQuery(window).scrollTop() + "px" }, { queue: false, duration: 500}, "fast");
    });
	</script>
<?php }
}
add_action('wp_footer','mts_sticky_sidebar', 100);

?>