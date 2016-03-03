<?php

function show_popular_posts(){	//SLIDER FRONT PAGE
		//Add FlexSlider
		wp_enqueue_style( 'flex-slider', 			get_template_directory_uri() . '/js/flex_slider/slider.css');
		wp_enqueue_script('flex-fitvid-j',			get_template_directory_uri() . '/js/flex_slider/jquery.flexslider-min.js', array( 'jquery' ), '20130930', false );
		wp_enqueue_script( 'flex-slider', 			get_stylesheet_directory_uri() . '/js/slider_init.js', array( 'jquery'));
	   	 
		$args=array(
			'orderby'    => 'comment_count',
			'post_type'   => 'post',
			'post_status'   => 'publish',
            'posts_per_page' => 5
		);
		$my_query = new WP_Query($args);
     
		if( $my_query->have_posts() ) {
		$out1 = "";
		$out1 .= '<h1>Chosen posts</h1>';
		
		$out1 .= '<div class="flexslider">';

			$out1 .= '<ul class="slides">';
				while ($my_query->have_posts()) : $my_query->the_post(); 
					$post_id = get_the_ID();
					$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium');
					$cat_name = getTheCategory(', ');
					$the_post_date = getDateToRussian(get_the_date('d F', $post_id ));
					if ( has_post_thumbnail() ) {
					$out1 .= '<li>
								<div class="post type-post last_posts">
									<div class="left-block-content">
										<header class="entry-header">
											<div class="the_post_thumbnail_div">
												<img src="'.$feat_image[0].'" width="240px" alt="'.get_the_title().'"/>
											</div>
										</header>
									</div>
									<div class="right-block-content-post">
										<h1 class="entry-title">
											<p><a href="'.get_Permalink($post->ID).'">'.get_the_title().'</a></p>
										</h1>										
										<div class="entry-content"><p>'.get_the_excerpt().'</p></div> 
									</div>
								</div>
							</li>';
							}
						else {
						$out1 .= '<li>
										<div class="post type-post last_posts">
											<div class="right-block-content-post" style="width: 100%">
												<h1 class="entry-title">
													<p><a href="'.get_Permalink($post_id).'">'.get_the_title().'</a></p>
												</h1>										
												<div class="entry-content"><p>'.get_the_excerpt().'</p></div> 
											</div>
										</div>
									</li>';
						};
				endwhile;
			$out1 .= '</ul>';
	   $out1 .= '</div>';
       }
		echo $out1;
    wp_reset_query();
}

function new_excerpt_length($length) {
	return 17;
}
add_filter('excerpt_length', 'new_excerpt_length'); 

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function excerpt_read_more_link($output) {
 global $post;
 return $output .= '<p class="padding"></p><a class="a_box_shadow" href="'. get_permalink($post->ID) . '"> Read More</a>';
}
add_filter('get_the_excerpt', 'excerpt_read_more_link');

function getDateToRussian($date) {
    $month = array("Январь"=>"Января", "Февраль"=>"Февраля", "Март"=>"Марта", "Апрель"=>"Апреля", "Май"=>"Мая", "Июнь"=>"Июня", "Июль"=>"Июля", "Август"=>"Августа", "Сентябрь"=>"Сентября", "Октябрь"=>"Октября", "Ноябрь"=>"Ноября", "Декабрь"=>"Декабря");
    $days = array("monday"=>"Понедельник", "tuesday"=>"Вторник", "wednesday"=>"Среда", "thursday"=>"Четверг", "friday"=>"Пятница", "saturday"=>"Суббота", "sunday"=>"Воскресенье");
    return str_replace(array_merge(array_keys($month), array_keys($days)), array_merge($month, $days), strtolower($date));
}

function getTheCategory( $separator = '', $parents='', $post_id = false ) {
	return get_the_category_list( $separator, $parents, $post_id );
}

function show_last_posts_list(){	//LAST POSTS FRONT PAGE LIST
   	 
		$args=array(
			'orderby'    => 'modified',
			'post_type'   => 'post',
			'post_status'   => 'publish',
            'posts_per_page' => 5
		);
		$my_query = new WP_Query($args);
     
		if( $my_query->have_posts() ) {
		$out1 = "";
		$out1 .= '<div id="last_posts">
					<h1>Last Pots</h1>';
			$out1 .= '<div class="last_container">';
				while ($my_query->have_posts()) : $my_query->the_post(); 
					$post_id = get_the_ID();
					$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium');
					$cat_name = getTheCategory(', ');
					$the_post_date = getDateToRussian(get_the_date('d F', $post_id ));
					if ( has_post_thumbnail() ) {
					$out1 .= '<div class="post type-post last_posts">
									<div class="left-block-content">
										<header class="entry-header">
											<div class="the_post_thumbnail_div">
												<img src="'.$feat_image[0].'" width="240px" alt="'.get_the_title().'"/>
											</div>
											<div class="entry-comment-img">
												<p class="the_date"> '.$the_post_date.' </p>
												<p class="the_category"><span>, Posted in: </span>'. $cat_name.' </p>
											</div>
										</header>
									</div>
									<div class="right-block-content-post">
										<h1 class="entry-title">
											<p><a href="'.get_Permalink($post_id).'">'.get_the_title().'</a></p>
										</h1>										
										<div class="entry-content"><p>'.get_the_excerpt().'</p></div> 
									</div>
								</div>';}
					else {
						$out1 .= '<div class="post type-post last_posts">
											<div class="right-block-content-post" style="width: 100%">
												<h1 class="entry-title">
													<p><a href="'.get_Permalink($post_id).'">'.get_the_title().'</a></p>
												</h1>										
												<div class="entry-content"><p>'.get_the_excerpt().'</p></div> 
												<div class="entry-comment-img" style="width: calc(100% - 25px)">
													<p class="the_date"> '.$the_post_date.' </p>
													<p class="the_category"><span>, Posted in: </span>'. $cat_name.' </p>
												</div>
											</div>
										</div>';
					};
				endwhile;
			$out1 .= '</div>';
	   $out1 .= '</div>';
       }
		echo $out1;
    wp_reset_query();
}	
		

function show_last_posts_blocks(){	//LAST POSTS FRONT PAGE CONTENT BLOCKS
	   	 
		$args=array(
			'orderby'    	=> 'modified',
			'order'			=> 'DESC',
			'post_type'   	=> 'post',
			'post_status'   => 'publish',
			'posts_per_page'=> 5
		);
		$my_query = new WP_Query($args);
		if( $my_query->have_posts() ) { 
		
		while ($my_query->have_posts()) : $my_query->the_post(); 
			get_template_part('content'); 
		endwhile; }
}

function my_search_form( $form ) {

    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
				<div><label class="screen-reader-text" for="s">' . __('Search for:', 'notes') . '</label>
					<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Search..."/>
					<input type="submit" id="searchsubmit" value="'. esc_attr__('Search', 'notes') .'" />
				</div>
			</form>';
    return $form;
}
add_filter( 'get_search_form', 'my_search_form' );

/*function for correct output date on russian language*/
function dateToRussian($date) {
    $month = array("Январь"=>"Января", "Февраль"=>"Февраля", "Март"=>"Марта", "Апрель"=>"Апреля", "Май"=>"Мая", "Июнь"=>"Июня", "Июль"=>"Июля", "Август"=>"Августа", "Сентябрь"=>"Сентября", "Октябрь"=>"Октября", "Ноябрь"=>"Ноября", "Декабрь"=>"Декабря");
    $days = array("monday"=>"Понедельник", "tuesday"=>"Вторник", "wednesday"=>"Среда", "thursday"=>"Четверг", "friday"=>"Пятница", "saturday"=>"Суббота", "sunday"=>"Воскресенье");
    echo str_replace(array_merge(array_keys($month), array_keys($days)), array_merge($month, $days), strtolower($date));
}

if ( ! function_exists( 'fruitful_get_responsive_style' ) ) {
	function fruitful_get_responsive_style () {
		$style_ = $back_style = $woo_style_ = '';
		$theme_options  = fruitful_get_theme_options("fruitful_theme_options"); 
		fruitful_add_custom_fonts();
		if (isset($theme_options['responsive']) && ($theme_options['responsive'] == 'on')) {
			if (class_exists('woocommerce')){wp_enqueue_style( 'woo-style', get_template_directory_uri() . '/woocommerce/woo.css');}
			if (!class_exists('ffs')){
				wp_enqueue_style('fontawesome-style',  get_template_directory_uri() . '/css/font-awesome.min.css');
			}
			wp_enqueue_style('main-style',  get_stylesheet_uri());
		} else {
			if (class_exists('woocommerce')){wp_enqueue_style( 'woo-style', get_template_directory_uri() . '/woocommerce/woo-fixed.css');}
			if (!class_exists('ffs')){
				wp_enqueue_style('fontawesome-style',  get_template_directory_uri() . '/css/font-awesome.min.css');
			}
			wp_enqueue_style('main-style',  get_stylesheet_directory_uri()  .'/fixed-style.css');
		}
	 
		if (!empty($theme_options['styletheme'])) {
			if ($theme_options['styletheme'] == 'off') {
				
				$style_ .= 'h1 {font-size : '.esc_attr($theme_options['h1_size']) .'px; }' . "\n";
				$style_ .= 'h2 {font-size : '.esc_attr($theme_options['h2_size']) .'px; }' . "\n";
				$style_ .= 'h3 {font-size : '.esc_attr($theme_options['h3_size']) .'px; }' . "\n";
				$style_ .= 'h4 {font-size : '.esc_attr($theme_options['h4_size']) .'px; }' . "\n";
				$style_ .= 'h5 {font-size : '.esc_attr($theme_options['h5_size']) .'px; }' . "\n";
				$style_ .= 'h6 {font-size : '.esc_attr($theme_options['h6_size']) .'px; }' . "\n";
	 
				$style_ .= 'h1, h2, h3, h4, h5, h6 {font-family : '. esc_attr($theme_options['h_font_family']) .'; } ' . "\n";
				$style_ .= '.main-navigation a     {font-family : '. esc_attr($theme_options['m_font_family']) .'; color : '.esc_attr($theme_options['menu_font_color']). '; } ' . "\n";
				$style_ .= '.main-navigation ul:not(.sub-menu) > li > a, .main-navigation ul:not(.sub-menu) > li:hover > a   { font-size : '.esc_attr($theme_options['m_size']) .'px;    } ' . "\n";
				$style_ .= '#main-menu-2, .nav-container, .main-navigation ul ul a {background-color : ' .esc_attr($theme_options['menu_bg_color']). '; color : '.esc_attr($theme_options['menu_font_color']). '; } ' . "\n";
				
				
				if (!empty($theme_options['menu_bg_color']))   { $style_ .= '.main-navigation {background-color : ' .esc_attr($theme_options['menu_bg_color']) . '; }' . "\n";  }
	   
				$style_ .= '#header_language_select a {font-family : '.  esc_attr($theme_options['m_font_family']) .';} ' . "\n";
				$style_ .= 'body {font-size : '. esc_attr($theme_options['p_size']) .'px; font-family : ' . esc_attr($theme_options['p_font_family']) . '; }' . "\n";
	 
	  
				if(!empty($theme_options['background_color']))  { $back_style .= ' background-color : '. esc_attr($theme_options['background_color']) .'; '; }
				if(!empty($theme_options['backgroung_img']))    { 
					$bg_url = array();
					$bg_url = wp_get_attachment_image_src(intval($theme_options['backgroung_img']), 'full'); 
					$bg_url = esc_url_raw($bg_url[0]);
					
					if(isset($theme_options['bg_repeating']) && ($theme_options['bg_repeating'] == 'on')) { 
						$back_style .= 'background-image : url(' .$bg_url .'); background-repeat : repeat; ';  
					} else {
						$back_style .= 'background-image : url(' .$bg_url .'); background-repeat : no-repeat; background-size:100% 100%; background-size:cover; background-attachment:fixed; ';  
					}
				}

				$style_ .= 'body {'. $back_style .'}' . "\n";
	 
				if(!empty($theme_options['container_bg_color']))  {
					$style_ .= '.page-container .container {background-color : '. esc_attr($theme_options['container_bg_color']) . '; } ' . "\n";
				}
	 
				/*Header styles*/
				if (!empty($theme_options['header_bg_color']))   { $style_ .= '.head-container, .head-container.fixed  {background-color : ' .esc_attr($theme_options['header_bg_color']) . '; }' . "\n";  }
				if (!empty($theme_options['header_img']))    {
					$header_url = wp_get_attachment_image_src(intval($theme_options['header_img']), 'full'); 
					$header_url = esc_url_raw($header_url[0]);
					$style_ .= '.head-container {background-image : url(' .esc_attr($header_url) . '); } ' . "\n";  
					
					if (!empty($theme_options['header_img_size'])){
						if ($theme_options['header_img_size'] == 'full'){
							$style_ .= '.head-container {background-size :cover; background-position:center center;} ' . "\n";  
						} else {
							$style_ .= '@media only screen and (max-width:480px){'."\n";
								$style_ .= '.head-container {background-size :300px; background-position:top center;} ' . "\n"; 
							$style_ .= '}'."\n";
							$style_ .= '@media only screen and (min-width:481px) and (max-width:767px){'."\n";
								$style_ .= '.head-container {background-size :420px; background-position:top center;} ' . "\n"; 
							$style_ .= '}'."\n";
							$style_ .= '@media only screen and (min-width:768px) and (max-width:959px){'."\n";
								$style_ .= '.head-container {background-size :768px; background-position:top center;} ' . "\n"; 
							$style_ .= '}'."\n";
							$style_ .= '@media only screen and (min-width:960px){'."\n";
								$style_ .= '.head-container {background-size :960px; background-position:top center;} ' . "\n"; 
							$style_ .= '}'."\n";
						}
					}
				}
				if (!empty($theme_options['header_height'])) {
					$style_ .= '.head-container {min-height : '.esc_attr($theme_options['header_height']).'px; }' . "\n";
					$header_search_padding = ( $theme_options['header_height'] - 50 ) / 2;
					$style_ .= '.search_field {padding : '.$header_search_padding.'px 0; }' . "\n";
				}
				if (!empty($theme_options['is_fixed_header'])) {
					if (isset($theme_options['is_fixed_header']) && ($theme_options['is_fixed_header'] == 'on')) {
						$style_ .= '.head-container {position : fixed; }' . "\n";  
					} else {
						$style_ .= '.head-container {position : relative; }' . "\n";  
					}
				}
				/*end of header styles*/
				

				if (!empty($theme_options['menu_btn_color']))    { $style_ .= '.main-navigation ul li.current_page_item a, .main-navigation ul li.current-menu-ancestor a, .main-navigation ul li.current-menu-item a, .main-navigation ul li.current-menu-parent a, .main-navigation ul li.current_page_parent a {background-color : '.esc_attr($theme_options['menu_btn_color']) . '; }' . "\n";  }
				if (!empty($theme_options['menu_hover_color']))  { $style_ .= '.main-navigation ul li.current_page_item a, .main-navigation ul li.current-menu-ancestor a, .main-navigation ul li.current-menu-item a, .main-navigation ul li.current-menu-parent a, .main-navigation ul li.current_page_parent a {color : '.esc_attr($theme_options['menu_hover_color']) . '; } ' . "\n";  }
	  
				$style_ .= '.main-navigation ul > li:hover>a {' . "\n";
					if (!empty($theme_options['menu_btn_color']))    { $style_ .= 'background-color : '. esc_attr($theme_options['menu_btn_color']) . '; ' . "\n"; }
					if (!empty($theme_options['menu_hover_color']))  { $style_ .= 'color : '.esc_attr($theme_options['menu_hover_color']) . ';  ' . "\n"; }
				$style_ .= ' } ' . "\n"; 
	  
				/*styles for dropdown menu*/
				$style_ .= '#masthead .main-navigation ul > li > ul > li > a {' . "\n";
					if (!empty($theme_options['dd_menu_bg_color']))    { $style_ .= 'background-color : '. esc_attr($theme_options['dd_menu_bg_color']) . '; ' . "\n"; }
					if (!empty($theme_options['dd_menu_font_color']))  { $style_ .= 'color : '.esc_attr($theme_options['dd_menu_font_color']) . ';  ' . "\n"; }
				$style_ .= ' } ' . "\n"; 

				$style_ .= '#masthead .main-navigation ul > li > ul > li:hover > a {' . "\n";
					if (!empty($theme_options['dd_menu_btn_color']))    { $style_ .= 'background-color : '. esc_attr($theme_options['dd_menu_btn_color']) . '; ' . "\n"; }
					if (!empty($theme_options['dd_menu_hover_color']))  { $style_ .= 'color : '.esc_attr($theme_options['dd_menu_hover_color']) . ';  ' . "\n"; }
				$style_ .= ' } ' . "\n"; 
				
				$style_ .= '#masthead .main-navigation ul > li ul > li.current-menu-item > a {' . "\n";
					if (!empty($theme_options['dd_menu_btn_color']))    { $style_ .= 'background-color : '. esc_attr($theme_options['dd_menu_btn_color']) . '; ' . "\n"; }
					if (!empty($theme_options['dd_menu_hover_color']))  { $style_ .= 'color : '.esc_attr($theme_options['dd_menu_hover_color']) . ';  ' . "\n"; }
				$style_ .= ' } ' . "\n"; 
				
				$style_ .= '#masthead div .main-navigation ul > li > ul > li > ul a {' . "\n";
					if (!empty($theme_options['dd_menu_bg_color']))    { $style_ .= 'background-color : '. esc_attr($theme_options['dd_menu_bg_color']) . '; ' . "\n"; }
					if (!empty($theme_options['dd_menu_font_color']))  { $style_ .= 'color : '.esc_attr($theme_options['dd_menu_font_color']) . ';  ' . "\n"; }
				$style_ .= ' } ' . "\n"; 

				$style_ .= '#masthead div .main-navigation ul > li > ul > li > ul li:hover a {' . "\n";
					if (!empty($theme_options['dd_menu_btn_color']))    { $style_ .= 'background-color : '. esc_attr($theme_options['dd_menu_btn_color']) . '; ' . "\n"; }
					if (!empty($theme_options['dd_menu_hover_color']))  { $style_ .= 'color : '.esc_attr($theme_options['dd_menu_hover_color']) . ';  ' . "\n"; }
				$style_ .= ' } ' . "\n"; 
					
				$style_ .= '#lang-select-block li ul li a{'. "\n";
					if (!empty($theme_options['dd_menu_bg_color']))    { $style_ .= 'background-color : '. esc_attr($theme_options['dd_menu_bg_color']) . '; ' . "\n"; }
					if (!empty($theme_options['dd_menu_font_color']))  { $style_ .= 'color : '.esc_attr($theme_options['dd_menu_font_color']) . ';  ' . "\n"; }
				$style_ .= '}' . "\n";
				
				$style_ .= '#lang-select-block li ul li a:hover{'. "\n";
					if (!empty($theme_options['dd_menu_btn_color']))    { $style_ .= 'background-color : '. esc_attr($theme_options['dd_menu_btn_color']) . '; ' . "\n"; }
					if (!empty($theme_options['dd_menu_hover_color']))  { $style_ .= 'color : '.esc_attr($theme_options['dd_menu_hover_color']) . ';  ' . "\n"; }
				$style_ .= '}' . "\n";
				
				$style_ .= '#lang-select-block li ul li.active a{'. "\n";
					if (!empty($theme_options['dd_menu_btn_color']))    { $style_ .= 'background-color : '. esc_attr($theme_options['dd_menu_btn_color']) . '; ' . "\n"; }
					if (!empty($theme_options['dd_menu_hover_color']))  { $style_ .= 'color : '.esc_attr($theme_options['dd_menu_hover_color']) . ';  ' . "\n"; }
				$style_ .= '}' . "\n";
				/*end of styles for dropdown menu*/
				
				/*styles for responsive full width menu*/
				if (!empty($theme_options['menu_type_responsive']) && ($theme_options['menu_type_responsive'] == 'full_width')) {
					$style_ .= '.resp_full_width_menu .site-header .menu_wrapper{'. "\n";
						if (!empty($theme_options['dd_menu_bg_color']))    { $style_ .= 'background-color : '. esc_attr($theme_options['dd_menu_bg_color']) . '; ' . "\n"; }
					$style_ .= '}' . "\n";
					$style_ .= '.resp_full_width_menu .site-header .menu_wrapper .menu li a{'. "\n";
						if (!empty($theme_options['dd_menu_font_color']))	{ $style_ .= 'color : '.esc_attr($theme_options['dd_menu_font_color']) . ';  ' . "\n"; }
					$style_ .= '}' . "\n";
					$style_ .= '.resp_full_width_menu .site-header .menu_wrapper .menu li.current-menu-item>a,'. "\n";
					$style_ .= '.resp_full_width_menu .site-header .menu_wrapper .menu li.current_page_item>a,'. "\n";
					$style_ .= '.resp_full_width_menu .site-header .menu_wrapper .menu a:hover{'. "\n";
						if (!empty($theme_options['dd_menu_btn_color']))    { $style_ .= 'background-color : '. esc_attr($theme_options['dd_menu_btn_color']) . '; ' . "\n"; }
						if (!empty($theme_options['dd_menu_hover_color']))  { $style_ .= 'color : '.esc_attr($theme_options['dd_menu_hover_color']) . ';  ' . "\n"; }
					$style_ .= '}' . "\n";
				}
				/*end of styles for responsive full width menu*/
	  
				$style_ .= '#header_language_select ul li.current > a { color : '.esc_attr($theme_options['menu_font_color']). '; } ' . "\n";
				if (!empty($theme_options['menu_bg_color'])) { $style_ .= '#header_language_select { background-color : '.esc_attr($theme_options['menu_bg_color']) . '; } ' . "\n";  }
	  
				$style_ .= '#header_language_select ul li.current:hover > a { ' . "\n";
					if (!empty($theme_options['menu_btn_color']))    { $style_ .= 'background-color : '. esc_attr($theme_options['menu_btn_color']) . ';' . "\n"; }
					if (!empty($theme_options['menu_hover_color']))  { $style_ .= 'color : '.esc_attr($theme_options['menu_hover_color']) . ';' . "\n"; }
				$style_ .= '} ' . "\n";
				
				/*Add Custom Colors to theme*/
				if (!empty($theme_options['p_font_color']))  	    { $style_ .= 'body {color : '. esc_attr($theme_options['p_font_color']) .'; } ' . "\n"; }
				if (!empty($theme_options['widgets_sep_color']))  { 
					$style_ .= '#page .container #secondary .widget h3.widget-title, #page .container #secondary .widget h1.widget-title, header.post-header .post-title  {border-color : '. esc_attr($theme_options['widgets_sep_color']) .'; } ' . "\n";
					$style_ .= 'body.single-product #page .related.products h2  {border-bottom-color : '. esc_attr($theme_options['widgets_sep_color']) .'; } ' . "\n";
				}
				if (!empty($theme_options['a_font_color']))   		{ 
					
					$a_font_color = esc_attr($theme_options['a_font_color']); 
					 
					$style_ .= 'a {color : '.$a_font_color.'; }'; 
					$style_ .= '#page .container #secondary>.widget_nav_menu>div>ul>li ul>li>a:before {color : '.$a_font_color.'; }'; 
					$style_ .= '#page .container #secondary .widget ul li.cat-item a:before {color : '.$a_font_color.'; }'; 
					$style_ .= 'html[dir="rtl"] #page .container #secondary>.widget_nav_menu>div>ul>li ul>li>a:after {color : '. $a_font_color .'; }'; 
					$style_ .= 'html[dir="rtl"] #page .container #secondary .widget ul li.cat-item a:after {color : '. $a_font_color .'; }'; 
				}
				
				if (!empty($theme_options['a_hover_font_color']))   { 
					$style_ .= 'a:hover   {color : '. esc_attr($theme_options['a_hover_font_color']) .'; } '  . "\n"; 
					
					$style_ .= '#page .container #secondary>.widget_nav_menu li.current-menu-item>a {color : '. esc_attr($theme_options['a_hover_font_color']) .'; } '; 
					
					$style_ .= '#page .container #secondary>.widget_nav_menu>div>ul>li ul>li>a:hover:before,
								#page .container #secondary>.widget_nav_menu>div>ul>li ul>li.current-menu-item>a:before,
								#page .container #secondary>.widget_nav_menu>div>ul>li ul>li.current-menu-item>a:hover:before{color : '. esc_attr($theme_options['a_hover_font_color']) .'; }'; 
					
					$style_ .= '#page .container #secondary .widget ul li.current-cat>a,
								#page .container #secondary .widget ul li.cat-item ul li.current-cat a:before,
								#page .container #secondary .widget ul li.cat-item a:hover:before{color : '. esc_attr($theme_options['a_hover_font_color']) .'; }'; 
					
					$style_ .= 'html[dir="rtl"] #page .container #secondary>.widget_nav_menu>div>ul>li ul>li>a:hover:after,'; 
					$style_ .= 'html[dir="rtl"] #page .container #secondary>.widget_nav_menu>div>ul>li ul>li.current-menu-item>a:after,'; 
					$style_ .= 'html[dir="rtl"] #page .container #secondary>.widget_nav_menu>div>ul>li ul>li.current-menu-item>a:hover:after{color : '. esc_attr($theme_options['a_hover_font_color']) .'; } '  . "\n"; 

					$style_ .= 'html[dir="rtl"] #page .container #secondary .widget ul li.current-cat>a,
								html[dir="rtl"] #page .container #secondary .widget ul li.current-cat>a:after,
								html[dir="rtl"] #page .container #secondary .widget ul li.cat-item a:hover:after{color : '. esc_attr($theme_options['a_hover_font_color']) .'; } '; 
				}
				
				if (!empty($theme_options['a_focus_font_color']))   { $style_ .= 'a:focus   {color : '. esc_attr($theme_options['a_focus_font_color']) .'; } '  . "\n"; }
				if (!empty($theme_options['a_active_font_color']))  { $style_ .= 'a:active  {color : '. esc_attr($theme_options['a_active_font_color']) .'; } ' . "\n"; }
				
				if (!empty($theme_options['date_of_post_b_color']))  { 
					$style_ .= '.blog_post .date_of_post  {background : none repeat scroll 0 0 '. esc_attr($theme_options['date_of_post_b_color']) .'; } ' . "\n";
				}
				
				if (!empty($theme_options['date_of_post_f_color']))  { 
					$style_ .= '.blog_post .date_of_post  {color : '. esc_attr($theme_options['date_of_post_f_color']) .'; } ' . "\n";
				}
				
				$woo_style_ .= '.num_of_product_cart {border-color: '. esc_attr($theme_options['menu_btn_color']) . '; }  ' . "\n"; 
				
				if (!empty($theme_options['btn_color'])) {
					$btn_color = esc_attr($theme_options['btn_color']);
					
					$style_		 .= 'button, input[type="button"], input[type="submit"], input[type="reset"], .right-block-content-post div.entry-content a{background-color : '.$btn_color.' !important; } ';
					$style_		 .= 'body a.btn.btn-primary, body button.btn.btn-primary, body input[type="button"].btn.btn-primary , body input[type="submit"].btn.btn-primary {background-color : '.$btn_color.' !important; }';
					$woo_style_  .= '.woocommerce table.my_account_orders .order-actions .button, .woocommerce-page table.my_account_orders .order-actions .button, body.woocommerce-cart .woocommerce a.button {background-color : '.$btn_color.' !important; }';
					$style_ 	 .= '.nav-links.shop .pages-links .page-numbers, .nav-links.shop .nav-next a, .nav-links.shop .nav-previous a{background-color : '.$btn_color.' !important; }';
				}
				
				if (!empty($theme_options['btn_active_color'])) {
					$btn_active_color = esc_attr($theme_options['btn_active_color']);
					
					$style_ .= 'button:hover, button:active, button:focus{background-color : '.$btn_active_color.' !important; }';
					$style_ .= 'input[type="button"]:hover, input[type="button"]:active, input[type="button"]:focus{background-color : '.$btn_active_color.' !important; }';
					$style_ .= 'input[type="submit"]:hover, input[type="submit"]:active, input[type="submit"]:focus{background-color : '.$btn_active_color.' !important; }';
					$style_ .= 'input[type="reset"]:hover, input[type="reset"]:active, input[type="reset"]:focus{background-color : '.$btn_active_color.' !important; }';
					$style_	.= 'body a.btn.btn-primary:hover, body button.btn.btn-primary:hover, body input[type="button"].btn.btn-primary:hover , body input[type="submit"].btn.btn-primary:hover {background-color : '.$btn_active_color.' !important; }';
					$woo_style_  .= '.woocommerce table.my_account_orders .order-actions .button:hover, .woocommerce-page table.my_account_orders .order-actions .button:hover, body.woocommerce-cart .woocommerce a.button:hover {background-color : '.$btn_active_color.' !important; }';
					$style_ .= '.nav-links.shop .pages-links .page-numbers:hover, .nav-links.shop .nav-next a:hover, .nav-links.shop .nav-previous a:hover, .nav-links.shop .pages-links .page-numbers.current{background-color : '.$btn_active_color.' !important; }';
				}
				
				/*social icons styles*/
				if (!empty($theme_options['soc_icon_bg_color'])) {
					$style_ .= '.social-icon>a>i{background:'.$theme_options['soc_icon_bg_color'].'}' . "\n";
				}
				if (!empty($theme_options['soc_icon_color'])) {
					$style_ .= '.social-icon>a>i{color:'.$theme_options['soc_icon_color'].'}' . "\n";
				}
				
				
				/*Woocommerce styles*/
				if (class_exists('woocommerce')){
					
					if (!empty($theme_options['woo_shop_sidebar'])){
						$shop_sidebar_template = $theme_options['woo_shop_sidebar'];
						if ($shop_sidebar_template == 3){	/*right sidebar template*/
							$woo_style_ .= '#page .container .woo-loop-content{float:left}'."\n";
							$woo_style_ .= '#page .container .woo-loop-sidebar{float:right}'."\n";
							$woo_style_ .= '#page .container .woo-loop-sidebar #secondary{float:right}'."\n";
							$woo_style_ .= '.woocommerce .woocommerce-ordering, .woocommerce-page .woocommerce-ordering{float:left}'."\n";
						} else {
							$woo_style_ .= '#page .container .woo-loop-content{float:right}'."\n";
							$woo_style_ .= '#page .container .woo-loop-sidebar{float:left}'."\n";
							$woo_style_ .= '#page .container .woo-loop-sidebar #secondary{float:left}'."\n";
							$woo_style_ .= '.woocommerce .woocommerce-ordering, .woocommerce-page .woocommerce-ordering{float:right}'."\n";
						}
					}
					
					if (!empty($theme_options['woo_product_sidebar'])){
						$product_sidebar_template = $theme_options['woo_product_sidebar'];
						if ($product_sidebar_template == 3){	/*right sidebar template*/
							$woo_style_ .= '.single-product #page .container .woo-loop-content{float:left}'."\n";
							$woo_style_ .= '.single-product #page .container .woo-loop-sidebar{float:right}'."\n";
							$woo_style_ .= '.single-product #page .container .woo-loop-sidebar #secondary{float:right}'."\n";
						} else {
							$woo_style_ .= '.single-product #page .container .woo-loop-content{float:right}'."\n";
							$woo_style_ .= '.single-product #page .container .woo-loop-sidebar{float:left}'."\n";
							$woo_style_ .= '.single-product #page .container .woo-loop-sidebar #secondary{float:left}'."\n";
						}
					}
					
					/*price color*/
					if (!empty($theme_options['a_hover_font_color']))   { 
						$woo_style_ .= '.woocommerce ul.products li.product .price ,
										.woocommerce-page ul.products li.product .price,
										body.woocommerce div.product span.price, 
										body.woocommerce-page div.product span.price, 
										body.woocommerce #content div.product span.price,
										body.woocommerce-page #content div.product span.price,
										body.woocommerce div.product p.price, 
										body.woocommerce-page div.product p.price,
										body.woocommerce #content div.product p.price, 
										body.woocommerce-page #content div.product p.price{color : '. esc_attr($theme_options['a_hover_font_color']) .'; }'; 
					}
					
					/*buttons color*/
					if (!empty($theme_options['btn_color'])) {
						$btn_color = esc_attr($theme_options['btn_color']);
						
						$woo_style_ .= '.woocommerce .woocommerce-message, .woocommerce-page .woocommerce-message{border-top:3px solid '.$btn_color.';}';
						$woo_style_ .= '.woocommerce .woocommerce-info, .woocommerce-page .woocommerce-info{border-top:3px solid '.$btn_color.';}';
						$woo_style_ .= '.single-product .woocommerce-message .button{background-color:'.$btn_color.';}';
					}
					
					/*buttons hover color*/
					if (!empty($theme_options['btn_active_color']))
					$woo_style_ .= '.single-product .woocommerce-message .button:hover{background-color:'.esc_attr($theme_options['btn_active_color']).';}';
					
					if (!empty($theme_options['woo_sale_price_color'])) {
						$color_rgba = fruitful_hex2rgb($theme_options['woo_sale_price_color']);
						$color = $color_rgba['red'] . ',' . $color_rgba['green'] . ',' . $color_rgba['blue'];
						$woo_style_ .= '.woocommerce ul.products li.product .price del, .woocommerce-page ul.products li.product .price del {color:rgba('.$color.',.5); }';
					}	
					
					if (!empty($theme_options['woo_rating_color_regular'])) {
						$woo_style_ .= '.woocommerce .star-rating, .woocommerce-page .star-rating,
										.woocommerce p.stars a.star-1, 
										.woocommerce p.stars a.star-2, 
										.woocommerce p.stars a.star-3, 
										.woocommerce p.stars a.star-4,
										.woocommerce p.stars a.star-5, 
										.woocommerce-page p.stars a.star-1, 
										.woocommerce-page p.stars a.star-2, 
										.woocommerce-page p.stars a.star-3, 
										.woocommerce-page p.stars a.star-4, 
										.woocommerce-page p.stars a.star-5 { 
											color:' .esc_attr($theme_options['woo_rating_color_regular']). '; }';
					}

					
					if (!empty($theme_options['woo_rating_color_active'])) {
						$woo_style_ .= '.woocommerce p.stars a.star-1:hover, 
										.woocommerce p.stars a.star-2:hover, 
										.woocommerce p.stars a.star-3:hover, 
										.woocommerce p.stars a.star-4:hover,
										.woocommerce p.stars a.star-5:hover, 
										.woocommerce-page p.stars a.star-1:hover, 
										.woocommerce-page p.stars a.star-2:hover, 
										.woocommerce-page p.stars a.star-3:hover, 
										.woocommerce-page p.stars a.star-4:hover, 
										.woocommerce-page p.stars a.star-5:hover,
										.woocommerce .star-rating:hover, .woocommerce-page .star-rating:hover { color:' .esc_attr($theme_options['woo_rating_color_active']). '; }';
					}
				
				}
				
				if (class_exists('BuddyPress')){
					if (!empty($theme_options['btn_color'])) {
						$style_ .= '#buddypress input[type=submit]{background-color : '.esc_attr($theme_options['btn_color']).' !important; } ' . "\n";
					}
					if (!empty($theme_options['btn_active_color'])) {
						$style_ .= '#buddypress input[type=submit]:hover, #buddypress input[type=submit]:active, #buddypress input[type=submit]:focus{background-color : '.esc_attr($theme_options['btn_active_color']).' !important; } ' . "\n";
					}
				}
				
			} else {
				$style_ .= 'body {font-family:Open Sans, sans-serif}' . "\n";
			}
		} 
			
		if (!empty($theme_options['custom_css'])) {
			$style_ .= wp_kses_stripslashes($theme_options['custom_css']) . "\n";
		}	
		
		wp_add_inline_style( 'main-style', fruitful_compress_code($style_)); 
		if ($woo_style_ != '') {
			wp_add_inline_style( 'woo-style', fruitful_compress_code($woo_style_)); 
		}	
	}
	add_action('wp_enqueue_scripts', 'fruitful_get_responsive_style', 99);
}

if ( ! function_exists( 'fruitful_metadevice' ) ) {
	function fruitful_metadevice() {
		$browser = '';				
		$browser_ip	= strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");		
		$browser_an	= strpos($_SERVER['HTTP_USER_AGENT'],"Android");		
		$browser_ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");			 
		if ($browser_ip  	== true) { $browser = 'iphone';  }	 
		if ($browser_an		== true) { $browser = 'android'; } 	 
		if ($browser_ipad 	== true) { $browser = 'ipad'; }

		if($browser == 'iphone') 	{ echo '<meta name="viewport" content="width=320, maximum-scale=1, user-scalable=0"/>';  } 
		if($browser == 'android') 	{ echo '<meta name="viewport" content="target-densitydpi=device-dpi, width=device-width" />'; } 
		if($browser == 'ipad') 		{ echo '<meta name="viewport" content="width=768px, minimum-scale=1.0, maximum-scale=1.0" />'; } 
	}
}

	function fruitful_get_content_with_custom_sidebar($curr_sidebar = null) {
		global $post;
		
		function get_content_part() {
			global $post;
			
			?>
			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">	
			<?php			
				/* Start the Loop */
				$page_on_front  = get_option('page_on_front');
				$page_for_posts = get_option('page_for_posts');
				
				if (is_page() && !empty($page_on_front) &&  !empty($page_for_posts) && ($page_on_front == $page_for_posts)) {
					echo '<div class="alert alert-danger"><strong>'.__("Front page displays Error.", 'notes').'</strong> '.__('Select different pages!', 'notes').'</div>';
					
				} else {
					if (!is_archive() && !is_search() && !is_404()) {
						if (is_home()) {
							if ( have_posts() ) : 
								/* The loop */ 
								while ( have_posts() ) : the_post(); 
									get_template_part( 'content', get_post_format() ); 
								endwhile; 
								fruitful_content_nav( 'nav-below' ); 
							else :
								get_template_part( 'no-results', 'index' ); 
							endif;
						} else {
							
							if ( have_posts() ) {
								while ( have_posts() ) : the_post();
									if (is_page() && !is_front_page() && !is_home()) {
										get_template_part( 'content', 'page' ); 

										if (fruitful_state_page_comment()) { 
											comments_template( '', true );  
										}
									} else if (is_single()) {
										get_template_part( 'content', get_post_format() );
										$tags_list = get_the_tag_list( '', __( ', ', 'notes' ) );
										$cat_name = getTheCategory(', ');
										$the_post_date = getDateToRussian(get_the_date('d F', $post->ID ));
										?>
										<div class="tag-list">
											<div class="date">
													<p class="the_date"><?php echo $the_post_date ?><span>, Posted in: </span> <?php echo $cat_name ?> </p>
											</div>
											<?php if( has_tag() )
												echo '<p class="tags">Tags: '.$tags_list.'</p>' ; ?> 
											
										</div>
										<?php fruitful_content_nav( 'nav-below' );
									
										if (fruitful_state_post_comment()) { 
											if ( comments_open() || '0' != get_comments_number() ) comments_template();  
										}
									} else if (is_front_page())	{
										get_template_part( 'content', 'page' );
									}
							   endwhile;
							}
						} 
					} else {
						?>
							<section id="primary" class="content-area">
								<div id="content" class="site-content" role="main">

								<?php if ( have_posts() ) : ?>
										<header class="page-header">
											<h1 class="page-title">
												<?php
													
													if ( is_archive()) {
														if ( is_category() ) {
															printf( __( 'Category Archives: %s', 'notes' ), '<span>' . single_cat_title( '', false ) . '</span>' );
														} elseif ( is_tag() ) {
															printf( __( 'Tag Archives: %s', 'notes' ), '<span>' . single_tag_title( '', false ) . '</span>' );
														} elseif ( is_author() ) {
															the_post();
															printf( __( 'Author Archives: %s', 'notes' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
															rewind_posts();

														} elseif ( is_day() ) {
															printf( __( 'Daily Archives: %s', 'notes' ), '<span>' . get_the_date() . '</span>' );
	
														} elseif ( is_month() ) {
															printf( __( 'Monthly Archives: %s', 'notes' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

														} elseif ( is_year() ) {
															printf( __( 'Yearly Archives: %s', 'notes' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

														} else {
															_e( 'Archives', 'notes' );
														}
													}
													
													if (is_search())
														printf( __( 'Search Results for: %s', 'notes' ), '<span>' . get_search_query() . '</span>' ); 
												?>
											</h1>
											<?php
												if ( is_category() ) {
													$category_description = category_description();
													if ( ! empty( $category_description ) )
														echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );

												} elseif ( is_tag() ) {
													$tag_description = tag_description();
													if ( ! empty( $tag_description ) )
														echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
												}
											?>
										</header><!-- .page-header -->

										<?php /* Start the Loop */ 
										while ( have_posts() ) : the_post(); 
											get_template_part( 'content', get_post_format() );
										endwhile; 
										fruitful_content_nav( 'nav-below' );
										
									else : 
										if (is_404()) {
											get_template_part( 'content', '404' );	
										} else {
											get_template_part( 'no-results', 'archive' );
										}	
										
									endif; ?>

								</div><!-- #content .site-content -->
							</section><!-- #primary .content-area -->
						<?php
					}
				}
			?>
				</div>
			</div>	
		<?php 
		}
		
		function get_html_custom_post_template($content_class, $sidebar_class, $curr_sidebar, $content_type) {
			global $post;
			$is_sidebar = true;
			$is_sidebar = fruitful_is_woo_sidebar();
				
			if ($content_type == 0) { ?>
				<?php get_content_part(); ?>	
		<?php } else if ($content_type == 1) { ?>
				
				<div class="eleven columns <?php echo $content_class;?>"><?php get_content_part(); ?> </div>	
				
				<?php if ($is_sidebar && is_page()) { ?>
					<div class="five columns <?php echo $sidebar_class;?>"> <?php get_sidebar($curr_sidebar); ?> </div>
				<?php } else { ?>	
					<div class="five columns <?php echo $sidebar_class;?>"> <?php get_sidebar($curr_sidebar); ?> </div>
				<?php } ?>	
				
		<?php } else if ($content_type == 2) { ?>
				
				<div class="eleven columns <?php echo $content_class;?>"> <?php get_content_part(); ?> </div>	
				
				<?php if ($is_sidebar && is_page()) { ?>
					<div class="five columns <?php echo $sidebar_class;?>"> <?php get_sidebar($curr_sidebar); ?> </div>
				<?php } else { ?>	
					<div class="five columns <?php echo $sidebar_class;?>"> <?php get_sidebar($curr_sidebar); ?> </div>
				<?php } ?>	
				
		<?php } 
		}
		
		$curr_template = '';
		$options = fruitful_get_theme_options();
		
		if (fruitful_is_latest_posts_page()) {
			$curr_template = esc_attr($options['latest_posts_templ']);
		} elseif (is_archive()) {
			if (is_tag()) {
				$curr_template = esc_attr($options['layout_tag_templ']);	
			} elseif (is_category()) {
				$curr_template = esc_attr($options['layout_cat_templ']);
			} elseif (is_author()) {
				$curr_template = esc_attr($options['layout_author_templ']);
			} else {
				$curr_template = esc_attr($options['layout_archive_templ']); 
			}	
		} elseif (is_404()) {
			$curr_template = esc_attr($options['layout_404_templ']);
		} elseif (is_search()) {
			$curr_template = esc_attr($options['layout_search_templ']);
		} else {
			$default_blog_template = (get_post_meta( get_option('page_for_posts', true), '_fruitful_page_layout', true ))?(get_post_meta( get_option('page_for_posts', true), '_fruitful_page_layout', true )-1) : 1;
			
			$default_post_template = (get_post_meta( $post->ID , '_fruitful_page_layout', true ))?(get_post_meta(  $post->ID , '_fruitful_page_layout', true )-1):esc_attr($options['layout_single_templ']);
			$default_page_template = (get_post_meta( $post->ID , '_fruitful_page_layout', true ))?(get_post_meta(  $post->ID , '_fruitful_page_layout', true )-1):esc_attr($options['layout_page_templ']);
			if (!fruitful_is_blog()) {
				if (is_archive()) {
					$curr_template = $default_blog_template;
				} else {
						
					if (class_exists('BuddyPress')){
						$bp_pages = get_option('bp-pages');			//possible pages - activity, members, register, activate
						foreach ($bp_pages as $bp_page_slug => $bp_page_id){
							if (bp_is_current_component($bp_page_slug)){
								$curr_template = (get_post_meta( $bp_page_id , '_fruitful_page_layout', true ))?(get_post_meta( $bp_page_id , '_fruitful_page_layout', true )-1):0;
							} else {
								$curr_template = $default_page_template;
							}
						}
					} else {
						$curr_template = $default_page_template;
					}
					
				}
			} else {
				if (is_single()) {
					$curr_template = $default_post_template;
				} else {
					$curr_template = $default_blog_template;
				}
			}
		}
		
		if ($curr_template == 0) { 
			get_html_custom_post_template('alpha', 'omega', $curr_sidebar, $curr_template);
		} else if ($curr_template == 1) { 
			get_html_custom_post_template('alpha', 'omega', $curr_sidebar, $curr_template);
		} else if ($curr_template == 2) {
			get_html_custom_post_template('omega', 'alpha', $curr_sidebar, $curr_template);
		} else {
			if (is_home()) {
				$curr_template = 1;
			}		
			get_html_custom_post_template('alpha', 'omega', $curr_sidebar, $curr_template);
		}
	}

add_action( 'after_setup_theme', function () {
    // load translation file for the child theme
    load_child_theme_textdomain( 'notes', get_stylesheet_directory() . '/languages' );
} );


function child_options($sections) {
		$sections['header'] = array(
			'title'		=> __( 'Header', 'fruitful' ),
			'id'		=> 'header',
			'fields'	=> array(	
				array(
					'id' 			=> 'menu_position',
					'label'			=> __( 'Menu Position' , 'fruitful' ),
					'info'          => __( 'Set menu position.', 'fruitful' ),			
					'type'			=> 'select',
					'options'		=> 	array( 
											'2' => __('Right', 'fruitful'), 
											'0' => __('Left', 'fruitful') , 
											'1' => __('Center', 'fruitful')
										),
					'default'		=> '2'
				),
				array(
					'id' 			=> 'menu_type_responsive',
					'label'			=> __( 'Type of Responsive menu' , 'fruitful' ),
					'info'          => __( 'Set type of responsive menu.', 'fruitful' ),			
					'type'			=> 'select',
					'options'		=>	array( 
											'inside_content' => __('Select menu', 'fruitful'), 
											'full_width' => __('Button menu', 'fruitful')
										),
					'default'		=> 'inside_content'
				),	
				array(
					'id' 			=> 'menu_icon_color',
					'label'			=> __( 'Menu icon color' , 'fruitful' ),
					'info'			=> __( 'Chose color for collapsing menu icon', 'fruitful' ),						
					'type'			=> 'color',
					'default'		=> '#333333',
				),				
				array(
					'label'			=> __( 'Background for header' , 'fruitful' ),
					'info'			=> __( 'Upload image with full width for background in header area. (Supported files .png, .jpg, .gif)', 'fruitful' ),			
					'fields'		=>  array (	
						array(
						'id' 			=> 'header_img',
						'type'			=> 'image',
						'imagetype'		=> 'headerbackground',
						),
						array(
						'id' 			=> 'header_bg_color',
						'type'			=> 'color',
						'default'		=> '#ffffff',
						'box-title'		=> __('Header background-color', 'fruitful')
						)					
					)
				),
				array(
					'id' 			=> 'header_img_size',
					'label'			=> __( 'Background image size' , 'fruitful' ),
					'info'  		=> __( 'Choose size for background image - full width or only for content area.', 'fruitful' ),			
					'type'			=> 'select',
					'options'		=>	array( 
											'full' => __('Full width position', 'fruitful'), 
											'centered' => __('Centered position', 'fruitful')
										),
					'default'		=> 'full'
				),				
				array(
					'id' 			=> 'header_height',
					'label'			=> __( 'Height for header area' , 'fruitful' ),
					'info'			=> __( 'Minimum height in pixels', 'fruitful' ),
					'type'			=> 'text',
					'default'		=> '80',
				),		
			)
		);
	return $sections;
}
add_filter('settings_fields', 'child_options');

function themeslug_option_defaults($output) {
	$output['is_fixed_header'] = 'off';
		return $output;
	}
add_filter('themeslug_option_defaults', 'themeslug_option_defaults');


	