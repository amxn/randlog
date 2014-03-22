<!DOCTYPE html>
<?php $mts_options = get_option('sensational'); ?>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php mts_meta(); ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body id ="blog" <?php body_class('main'); ?> itemscope itemtype="http://schema.org/WebPage">
<div class="main-container <?php if ($mts_options['mts_layout'] != 'scslayout' || $mts_options['mts_layout'] != 'scclayout') { echo 'threecolumns'; } ?>">
	<?php if($mts_options['mts_floating_header'] == '1') { ?>
		<div class="clear" id="catcher"></div>
		<header id="sticky" class="main-header">
	<?php } else { ?>
		<header class="main-header">
	<?php } ?>
		<div class="container">
			<div id="header">
				<div class="logo-wrap">
					<?php if ($mts_options['mts_logo'] != '') { ?>
						<?php if( is_front_page() || is_home() || is_404() ) { ?>
								<h1 id="logo" class="image-logo">
									<a href="<?php echo home_url(); ?>"><img src="<?php echo $mts_options['mts_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
								</h1><!-- END #logo -->
						<?php } else { ?>
							  <h2 id="logo" class="image-logo">
									<a href="<?php echo home_url(); ?>"><img src="<?php echo $mts_options['mts_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
								</h2><!-- END #logo -->
						<?php } ?>
					<?php } else { ?>
						<?php if( is_front_page() || is_home() || is_404() ) { ?>
								<h1 id="logo" class="text-logo">
									<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
								</h1><!-- END #logo -->
						<?php } else { ?>
							  <h2 id="logo" class="text-logo">
									<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
								</h2><!-- END #logo -->
						<?php } ?>
					<?php } ?>
				</div>
				<div class="main-navigation">
				<nav id="navigation" class="clearfix">
					<?php if ( has_nav_menu( 'primary-menu' ) ) { ?>
						<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu clearfix', 'container' => '' ) ); ?>
					<?php } else { ?>
						<ul class="menu">
							<li class="home-tab"><a href="<?php echo home_url(); ?>">Home</a></li>
                            <?php wp_list_pages('title_li='); ?>
                        </ul>
					<?php } ?>
					<a href="#" id="pull"><?php _e('Menu','mythemeshop'); ?></a>
				</nav>
				<?php mts_cart(); ?>
				</div>
				<a href="http://www.floh.in/?utm_source=SITC">
					<img class="blog-logo" src="https://s3.amazonaws.com/floh-blog/2014/03/logo.png">
				</a>
			</div><!--#header-->
		</div><!--.container-->        
	</header>
	<div id="content_area">