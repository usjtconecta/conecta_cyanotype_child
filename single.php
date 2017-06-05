<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package Conecta - Cyanotype Child
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			get_template_part( 'content', 'single' );

			// Previous/next post navigation.
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'cyanotype' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Next post:', 'cyanotype' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'cyanotype' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', 'cyanotype' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );

		// End the loop.
		endwhile;
		?>

		</main><!-- .site-main -->

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("conecta_banner") ) : ?>
<?php endif;?>

	</div><!-- .content-area -->

<?php get_footer(); ?>
