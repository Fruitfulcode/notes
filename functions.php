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
		$out1 .= '<h1>Избранные заметки</h1>';
		
		$out1 .= '<div class="flexslider">';

			$out1 .= '<ul class="slides">';
				while ($my_query->have_posts()) : $my_query->the_post(); 
					/*$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );*/
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
													<p><a href="'.get_Permalink($post->ID).'">'.get_the_title().'</a></p>
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
 return $output .= '<p class="padding"></p><a class="a_box_shadow" href="'. get_permalink($post->ID) . '"> ПОДРОБНЕЕ</a>';
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
					<h1>Последние заметки</h1>';
			$out1 .= '<div class="last_container">';
				while ($my_query->have_posts()) : $my_query->the_post(); 
					/*$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );*/
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
												<p class="the_category"><span>, категория: </span>'. $cat_name.' </p>
											</div>
										</header>
									</div>
									<div class="right-block-content-post">
										<h1 class="entry-title">
											<p><a href="'.get_Permalink($post->ID).'">'.get_the_title().'</a></p>
										</h1>										
										<div class="entry-content"><p>'.get_the_excerpt().'</p></div> 
									</div>
								</div>';}
					else {
						$out1 .= '<div class="post type-post last_posts">
											<div class="right-block-content-post" style="width: 100%">
												<h1 class="entry-title">
													<p><a href="'.get_Permalink($post->ID).'">'.get_the_title().'</a></p>
												</h1>										
												<div class="entry-content"><p>'.get_the_excerpt().'</p></div> 
												<div class="entry-comment-img" style="width: 100%">
													<p class="the_date"> '.$the_post_date.' </p>
													<p class="the_category"><span>, категория: </span>'. $cat_name.' </p>
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
				<div><label class="screen-reader-text" for="s">' . __('Search for:') . '</label>
					<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Введите критерии поиска"/>
					<input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
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
					echo '<div class="alert alert-danger"><strong>'.__("Front page displays Error.", 'fruitful').'</strong> '.__('Select different pages!', 'fruitful').'</div>';
					
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
										$tags_list = get_the_tag_list( '', __( ', ', 'fruitful' ) );
										$cat_name = getTheCategory(', ');
										$the_post_date = getDateToRussian(get_the_date('d F', $post_id ));
										?>
										<div class="tag-list">
											<div class="date">
													<p class="the_date"><?php echo $the_post_date ?><span>, категория: </span> <?php echo $cat_name ?> </p>
											</div>
											<p class="tags">Tags: <?php echo $tags_list; ?> </p>
											
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
															printf( __( 'Category Archives: %s', 'fruitful' ), '<span>' . single_cat_title( '', false ) . '</span>' );
														} elseif ( is_tag() ) {
															printf( __( 'Tag Archives: %s', 'fruitful' ), '<span>' . single_tag_title( '', false ) . '</span>' );
														} elseif ( is_author() ) {
															the_post();
															printf( __( 'Author Archives: %s', 'fruitful' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
															rewind_posts();

														} elseif ( is_day() ) {
															printf( __( 'Daily Archives: %s', 'fruitful' ), '<span>' . get_the_date() . '</span>' );
	
														} elseif ( is_month() ) {
															printf( __( 'Monthly Archives: %s', 'fruitful' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

														} elseif ( is_year() ) {
															printf( __( 'Yearly Archives: %s', 'fruitful' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

														} else {
															_e( 'Archives', 'fruitful' );
														}
													}
													
													if (is_search())
														printf( __( 'Search Results for: %s', 'fruitful' ), '<span>' . get_search_query() . '</span>' ); 
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