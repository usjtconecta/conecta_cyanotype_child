<?php
/**
 * @package Conecta - Cyanotype Child
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry-date">
			<span class="posted-on"><a href="<?php echo get_permalink() ?>" rel="bookmark"><?php get_time_string(); ?></a></span>
		</div>

	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	<figure class="wp-caption">
	<?php cyanotype_post_thumbnail(); ?><br />
	<figcaption class="wp-caption-text"><?php echo the_post_thumbnail_caption(); ?></figcaption>
	</figure>
	</header>


	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'cyanotype' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'cyanotype' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
	<span class="tags-links"><?php the_tags( 'Assuntos: ', ', ', '<br />' ); ?></span>
	<?php edit_post_link( __( 'Edit', 'cyanotype' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
