<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package Conecta - Cyanotype Child
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-date">
				<span class="posted-on"><?php get_time_string(); ?></span>
			</div><!-- .entry-date -->
		<?php endif; ?>
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header>
	<?php if ( has_post_thumbnail()) : ?>
	<?php the_post_thumbnail('homepage-thumb', array('class' => 'alignright')); ?>
	<?php endif; ?>
		<?php echo the_excerpt(); ?> 

</article><!-- #post-## -->
