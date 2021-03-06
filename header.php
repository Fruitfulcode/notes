<?php
/** 
* The Header for our theme. 
* Displays all of the <head> section and everything up till <div id="main"> 
* @package WordPress 
* @subpackage Fruitful theme 
* @since Fruitful theme 1.0 
**/
?><!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php fruitful_get_favicon(); ?>
<!--[if lt IE 9]><script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script><![endif]-->
<?php wp_head(); ?> 
</head>
<body <?php body_class();?>>
	<div id="page-header" class="hfeed site">
	<?php
		$theme_options  = fruitful_get_theme_options();
		$logo_pos = $menu_pos = '';
		
		if (isset($theme_options['logo_position'])) 
		$logo_pos = esc_attr($theme_options['logo_position']);
		
		if (isset($theme_options['menu_position'])) 
		$menu_pos = esc_attr($theme_options['menu_position']);
		
		$logo_pos_class = fruitful_get_class_pos($logo_pos);
		$menu_pos_class = fruitful_get_class_pos($menu_pos);
		
		$responsive_menu_type = esc_attr($theme_options['menu_type_responsive']);
		$is_responsive  	  = (isset($theme_options['responsive']) && ($theme_options['responsive'] == 'on'));
		
			
			if ( !$is_responsive || ( $is_responsive && ( $responsive_menu_type == 'inside_content' ) ) ) { ?>
			
	<div class="header-container">
		<div class="container">
			<div class="sixteen columns">
				<header id="masthead" class="site-header" role="banner">
					<?php 	
						if (fruitful_is_social_header()) { 
							fruitful_get_socials_icon(); 
						}	 
					?>
					<?php fruitful_get_cart_button_html(); ?>
					<div data-originalstyle="<?php echo $logo_pos_class; ?>" class="header-hgroup <?php echo $logo_pos_class; ?>">  
						<?php echo fruitful_get_logo(); ?>
					</div>	
				</header><!-- #masthead .site-header -->
			</div>
		</div>
		<div class="nav-container">
			<div class="container">
				<div class="sixteen columns">
					<div data-originalstyle="<?php echo $menu_pos_class; ?>" class="menu-wrapper <?php echo $menu_pos_class; ?>">
							<?php fruitful_get_languages_list(); ?>
								
						<nav role="navigation" class="site-navigation main-navigation">
								<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
						</nav><!-- .site-navigation .main-navigation -->
						
					</div>
				</div>				
			</div>
		</div>
		<div class="site-header">
			<div class="logo_wrapper"><?php echo fruitful_get_logo(); ?></div>
			<div class="cart_wrapper"><?php fruitful_get_cart_button_html(); ?></div>
			<div class="language_switcher"><?php fruitful_get_languages_list(); ?></div>
			<div class="menu_wrapper collapse"><?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?></div>
		</div>
		<div class="head-container">
			<article id="post-0" class="search-field no-results not-found">
				<div class="entry-content">
					<div class="search_field"><?php get_search_form(); ?></div>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
		</div>
					
			<?php } else { ?>
				
					<div class="header-container resp_full_width_menu">
						<div class="container">
							<div class="sixteen columns">
								<header id="masthead" class="site-header" role="banner">
									<?php 	
										if (fruitful_is_social_header()) { 
											fruitful_get_socials_icon(); 
										}	 
									?>
									<?php fruitful_get_cart_button_html(); ?>
									<div data-originalstyle="<?php echo $logo_pos_class; ?>" class="header-hgroup <?php echo $logo_pos_class; ?>">  
										<?php echo fruitful_get_logo(); ?>
									</div>	
								</header><!-- #masthead .site-header -->
							</div>
						</div>
						<div class="nav-container">
							<div class="container">
								<div class="sixteen columns">
									<div data-originalstyle="<?php echo $menu_pos_class; ?>" class="menu-wrapper <?php echo $menu_pos_class; ?>">
											<?php fruitful_get_languages_list(); ?>
												
										<nav role="navigation" class="site-navigation main-navigation">
												<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
										</nav><!-- .site-navigation .main-navigation -->
										
									</div>
								</div>				
							</div>
						</div>
						<div class="site-header">
							<div class="logo_wrapper"><?php echo fruitful_get_logo(); ?></div>
							<div class="menu_button collapsed">
								<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<div class="cart_wrapper"><?php fruitful_get_cart_button_html(); ?></div>
							<div class="language_switcher"><?php fruitful_get_languages_list(); ?></div>
							<div class="menu_wrapper collapse"><?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?></div>
						</div>
						<div class="head-container">
							<article id="post-0" class="search-field no-results not-found">
								<header class="entry-header">
									<p class="entry-title"><?php //_e( 'Nothing Found', ); ?></p>
								</header>

								<div class="entry-content">
									<?php //_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', ); ?>
									<div class="search_field"><?php get_search_form(); ?></div>
								</div><!-- .entry-content -->
							</article><!-- #post-0 -->
						</div>
					</div>
					
			<?php } ?>
	</div><!-- .header-container -->
	
	<?php fruitful_get_slider(); ?>
	
	<div id="page" class="page-container">		
		<div class="container">		
			<?php do_action( 'before' ); ?>		
				<div class="sixteen columns">