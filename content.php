<?php
/**
 * @package WordPress
 * @subpackage Fruitful theme
 * @since Fruitful theme 1.0
 */
?>
<?php $options = fruitful_get_theme_options(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="left-block-content">
			<header class="entry-header">
				<div class="the_post_thumbnail_div">
					<?php //the_post_thumbnail(); ?> 
					
					<?php /*TIMTHUMB*/ ?>
					<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false, '' );
							 $thumbnailSrc = $src[0]; ?>
					<img class="news-images" src="<?php echo $thumbnailSrc; ?>" width="240px" alt="" />
					<?php /*END TIMTHUMB*/ ?>
					
				</div>
				<div class="entry-commemnt-img">
					<p class="the_date"><?php dateToRussian(the_date('d F', '<span>', '</span>', false)); ?></p>
					<p class="the_category">, категория: <?php the_category(', '); ?></p>  
				</div>
			</header><!-- .entry-header -->
		</div>  <!-- end left-block-content -->

		<!-- div class="right-block-content" -->
			<?php if ( is_single() ) : {echo ('<div class="right-block-content">'); ?>
				<h1 class="entry-title"><?php the_title();} ?></h1>
				<?php else : {echo ('<div class="right-block-content-post">'); ?>
				<p class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title();} ?></a>
				</p>
				<?php endif; // is_single() ?>
		
			<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<div class="featured-post">
				<?php _e( 'Feature	d post', 'twentytwelve' ); ?>
			</div>
			<?php endif; ?>

			<?php if ( is_search() ) : // Only display Excerpts for Search ?>
			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
			
			<?php else : ?>
			<div class="entry-content">
				<?php if ( is_single() ) : the_content(); else : the_excerpt(); endif;  ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
			<?php endif; ?>
			
		</div>  <!-- end right-block-content -->
</article><!-- #post-<?php the_ID(); ?> -->
