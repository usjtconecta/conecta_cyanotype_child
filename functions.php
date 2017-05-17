<?php

// Remove WP Version

function wpb_remove_version() {
return '';
}
add_filter('the_generator', 'wpb_remove_version');

// CSS

add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_styles', PHP_INT_MAX);
function enqueue_child_theme_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(), array('parent-style')  );
}

// Guest Author

add_filter( 'the_author', 'guest_author_name' );
add_filter( 'get_the_author_display_name', 'guest_author_name' );

function guest_author_name( $name ) {
global $post;

$author = get_post_meta( $post->ID, 'autor', true );

if ( $author )
$name = $author;

return $name;
}

// Clean archives

add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;
        }
    return $title;
});

// Thumbnail

if ( function_exists( 'add_theme_support' ) ) { 
add_theme_support( 'post-thumbnails' );
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'homepage-thumb', 250, 140, true ); //(cropped)
}

// Post Thumbnail Caption

if ( ! function_exists( 'the_post_thumbnail_caption' ) ) {
 function the_post_thumbnail_caption() {
  global $post;

  $thumbnail_id    = get_post_thumbnail_id($post->ID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

   if ($thumbnail_image && isset($thumbnail_image[0])) {
    return '<div class="front-caption">'.$thumbnail_image[0]->post_excerpt.'</div>';
   } else {
     return;
   }
 }
}

// Time String

if ( ! function_exists( 'get_time_string' ) ) {
 function get_time_string() {

	if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date('d/m/Y'),
			esc_attr( get_the_modified_date( 'c' ) ),
			get_the_modified_date('d/m/Y')
		);

		printf( $time_string );
   }
 }
}
