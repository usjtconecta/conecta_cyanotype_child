<?php

// Conecta Banner

if ( function_exists('register_sidebar') )
  register_sidebar(array(
	'name' => __( 'Banner Conecta', 'conecta_banner' ),
	'id' => 'conecta_banner',
	'before_widget' => '<div class="conecta-banner">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  )
);

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

//Adds the "nofollow" rel attribute to "read more" link
add_filter('the_content_more_link','add_nofollow_to_link', 0); 
function add_nofollow_to_link($link) { return str_replace('<a', '<a rel="nofollow"', $link); } 
//nofollow tag_cloud
add_filter('wp_tag_cloud', 'cis_nofollow_tag_cloud');
function cis_nofollow_tag_cloud($text) {
    return str_replace('<a href=', '<a rel="nofollow" href=',$text); 
}

//nofollow posts tags
add_filter('the_tags', 'cis_nofollow_the_tag');
function cis_nofollow_the_tag($text) {
    return str_replace('rel="tag"', 'rel="tag nofollow"', $text);
}
//nofollow archive links
add_filter( 'get_archives_link', 'nofollow_archive' );
function nofollow_archive( $text ) {
	$text = stripslashes($text);
	$text = preg_replace_callback('|<a (.+?)>|i','wp_rel_nofollow_callback', $text);
	return $text;
}
 
//nofollow categories
add_filter( 'wp_list_categories', 'cis_nofollow_wp_list_categories' );
function cis_nofollow_wp_list_categories( $text ) {
$text = stripslashes($text);
$text = preg_replace_callback('|<a (.+?)>|i','wp_rel_nofollow_callback', $text);
return $text;
}

//nofollow post category
add_filter( 'the_category', 'cis_nofollow_the_category' );
function cis_nofollow_the_category( $text ) {
$text = str_replace('rel="category tag"', "", $text);
$text = cis_nofollow_wp_list_categories($text);
return $text;
}

//nofollow post author link
add_filter('the_author_posts_link', 'cis_nofollow_the_author_posts_link');
function cis_nofollow_the_author_posts_link ($link) {
return str_replace('</a><a href=', '<a rel="nofollow" href=',$link); 
}