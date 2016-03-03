<?php
/**
 * The template for displaying 404 single pages (Not Found).
 *
 * @package WordPress
 * @subpackage Fruitful theme
 * @since Fruitful theme 1.0
 */
?>

<article id="post-0" <?php post_class('post error404 not-found'); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'notes' ); ?></h1>
	</header><!-- .entry-header -->
				
	<div class="entry-content 404-content">
		<p style="text-align: center"><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'notes' ); ?></p>
	</div><!-- .entry-content -->
</article><!-- #post -->
