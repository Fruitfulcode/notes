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
					$out1 .= '<div class="post type-post last_posts">
									<div class="left-block-content">
										<header class="entry-header">
											<div class="the_post_thumbnail_div">
												<img src="'.$feat_image[0].'" width="240px" alt="'.get_the_title().'"/>
											</div>
											<div class="entry-comment-img">
												<p class="the_date"> '.$the_post_date.' </p>
												<p class="the_category">, категория: '.$cat_name.' </p>
											</div>
										</header>
									</div>
									<div class="right-block-content-post">
										<h1 class="entry-title">
											<p><a href="'.get_Permalink($post->ID).'">'.get_the_title().'</a></p>
										</h1>										
										<div class="entry-content"><p>'.get_the_excerpt().'</p></div> 
									</div>
								</div>';
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
