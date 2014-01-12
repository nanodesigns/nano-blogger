<?php

/**
 * Adds support for a custom header image.
 */
require( get_template_directory() . '/inc/user-header.php' );



/* ENABLING CUSTOM MENUS
-------------------------------------------------- */
//add_theme_support( 'menus' );

register_nav_menus(
	array(
	'primary'=>__('Primary Menu'),
	'secondary'=>__('Secondary Menu'),
	)
);


// Make theme available for translation
// Translations can be filed in the /languages/ directory
load_theme_textdomain( 'nano-blogger', get_template_directory() . '/languages' );


$locale = get_locale();
$locale_file = get_template_directory() . "/languages/$locale.php";
if ( is_readable($locale_file) )
        require_once($locale_file);


// Custom width

if ( ! isset( $content_width ) ) $content_width = 1000;

// AUTOMATIC FEED LINKS

add_theme_support( 'automatic-feed-links'  );

// CUSTOM EDITOR STYLES
// This theme styles the visual editor with editor-style.css to match the theme style.

add_editor_style();


// FEATURED IMAGE SUPPORT

add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop


// ADDING CUSTOM BACKGROUND

$defaults = array(
	'default-color'          => '#FFFFFF',
	'default-image'          => '',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
);

add_theme_support( 'custom-background', $defaults );


// Get the page number
function get_page_number() {
    if (get_query_var('paged')) {
        print ' | ' . __( 'Page ' , 'nano-blogger') . get_query_var('paged');
    }
} // end get_page_number




// For category lists on category archives: Returns other categories except the current one (redundant)
function cats_meow($glue) {
        $current_cat = single_cat_title( '', false );
        $separator = "\n";
        $cats = explode( $separator, get_the_category_list($separator) );
        foreach ( $cats as $i => $str ) {
                if ( strstr( $str, ">$current_cat<" ) ) {
                        unset($cats[$i]);
                        break;
                }
        }
        if ( empty($cats) )
                return false;


        return trim(join( $glue, $cats ));
} // end cats_meow




// For tag lists on tag archives: Returns other tags except the current one (redundant)
function tag_ur_it($glue) {
        $current_tag = single_tag_title( '', '',  false );
        $separator = "\n";
        $tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
        foreach ( $tags as $i => $str ) {
                if ( strstr( $str, ">$current_tag<" ) ) {
                        unset($tags[$i]);
                        break;
                }
        }
        if ( empty($tags) )
                return false;


        return trim(join( $glue, $tags ));
} // end tag_ur_it




// Register widgetized areas
function theme_widgets_init() {
        // Area 1
  register_sidebar( array (
  'name' => 'Primary Widget Area',
  'id' => 'primary_widget_area',
  'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
  'after_widget' => "</li>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
  ) );


        // Area 2
  register_sidebar( array (
  'name' => 'Secondary Widget Area',
  'id' => 'secondary_widget_area', 
  'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
  'after_widget' => "</li>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
  ) );
} // end theme_widgets_init


add_action( 'init', 'theme_widgets_init' );


/*

// THIS SECTION OF CODES IS NO LONGER NEEDED BECAUSE DEFAULT WIDGETS ARE HARD CODED IN sidebar.php

// DEFAULT WIDGET ACTIVATION

function set_default_theme_widgets ( $old_theme, $WP_theme = null ) {
    // check if the new theme is your theme
    // figure it out
    //var_dump($WP_theme);

    // the name is (probably) the slug/id
    $preset_widgets = array (
        'primary_widget_area'  => array( 'search', 'pages', 'categories', 'archives' ),
        'secondary_widget_area'  => array( 'links', 'meta' )
	);

    // save new widgets to DB
	update_option( 'widget_categories', array( 'title' => 'My Categories' ));
	update_option( 'sidebars_widgets', array( "sidebar" => array( "categories" ) ) );
    update_option( 'sidebars_widgets', $preset_widgets );
}
add_action('after_switch_theme', 'set_default_theme_widgets', 10, 2);



// Preset Widgets
$preset_widgets = array (
        'primary_widget_area'  => array( 'search', 'pages', 'categories', 'archives' ),
        'secondary_widget_area'  => array( 'links', 'meta' )
);

if ( isset( $_GET['activated'] ) ) {
        update_option( 'sidebars_widgets', $preset_widgets );
}

//update_option( 'sidebars_widgets', NULL );




// Check for static widgets in widget-ready areas
function is_sidebar_active( $index ){
  
  global $wp_registered_sidebars;

  $widgetcolums = wp_get_sidebars_widgets();
                 
  if ($widgetcolums[$index]) return true;
  
        return false;
		
} // end is_sidebar_active

*/

// Template for comments and pingbacks.
if ( ! function_exists( 'nanodesigns_comment' ) ) :

function nanodesigns_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'nano-blogger' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'nano-blogger' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'nano-blogger' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'nano-blogger' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'nano-blogger' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'nano-blogger' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'nano-blogger' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;


// Filtering wp_title()

function nanoblogger_filter_wp_title( $title ) {
    // Get the Site Name
    $site_name = get_bloginfo( 'name' );
    // Prepend it to the default output
    $filtered_title =  $site_name . ' &lt;&gt; ' . $title;
    // If site front page, append description
    if ( is_front_page() ) {
        // Get the Site Description
        $site_description = get_bloginfo( 'description' );
        // Append Site Description to title
		$filtered_title .= $site_description;
    }
    // Return the modified title
    return $filtered_title;
}
// Hook into 'wp_title'
add_filter( 'wp_title', 'nanoblogger_filter_wp_title' );


// Conditional CSS for different types of menus

function conditional_enqueue_scripts() {
    if ( has_nav_menu( 'secondary' ) ) {
        wp_enqueue_style( 'conditional-1', get_template_directory_uri() . '/styles/conditional-1.css' );
    }
    if ( has_nav_menu( 'primary' ) ) {
        wp_enqueue_style( 'conditional-2', get_template_directory_uri() . '/styles/conditional-2.css' );
    }
    if ( ! has_nav_menu( 'primary' ) && ! has_nav_menu( 'secondary' ) ) {
        wp_enqueue_style( 'conditional-3', get_template_directory_uri() . '/styles/conditional-3.css' );
    }
}

add_action( 'wp_enqueue_scripts', 'conditional_enqueue_scripts' );