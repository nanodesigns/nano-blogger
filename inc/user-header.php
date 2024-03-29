<?php
/**
 * Implements an optional user header for nano blogger.
 * See http://codex.wordpress.org/Custom_Headers
 *
 */
function nanodesigns_custom_header_setup() {
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '0669B2',
		'default-image'          => get_template_directory_uri() . '/images/headers/thela.jpg',

		// Set height and width, with a maximum value for the width.
		'height'                 => 250,
		'width'                  => 980,
		'max-width'              => 2000,

		// Support flexible height and width.
		'flex-height'            => true,
		'flex-width'             => true,

		// Random image rotation off by default.
		'random-default'         => false,

		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => 'nanodesigns_header_style',
		'admin-head-callback'    => 'nanodesigns_admin_header_style',
		'admin-preview-callback' => 'nanodesigns_admin_header_image',
	);

	add_theme_support( 'custom-header', $args );
	
}
add_action( 'after_setup_theme', 'nanodesigns_custom_header_setup' );


// Default header image
	register_default_headers( array(
		'thela' => array(
			'url' => '%s/images/headers/thela.jpg',
			'thumbnail_url' => '%s/images/headers/thela-thumbnail.jpg',
			'description' => __( 'thela', 'nano-blogger' )
		),
		'chorui' => array(
			'url' => '%s/images/headers/chorui.jpg',
			'thumbnail_url' => '%s/images/headers/chorui-thumbnail.jpg',
			'description' => __( 'chorui', 'nano-blogger' )
		)		
	) );


function nanodesigns_header_style() {
	$text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	if ( $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
		return;

	// If we get this far, we have custom styles.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		#blog-title,
		#blog-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text, use that.
		else :
	?>
		#blog-title a,
		#blog-description {
			color: #<?php echo $text_color; ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}


function nanodesigns_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1,
	#headimg h2 {
		line-height: 1.6;
		margin: 0;
		padding: 0;
	}
	#headimg h1 {
		font-size: 30px;
	}
	#headimg h1 a {
		color: #515151;
		text-decoration: none;
	}
	#headimg h1 a:hover {
		color: #21759b;
	}
	#headimg h2 {
		color: #757575;
		font: normal 13px/1.8 "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", sans-serif;
		margin-bottom: 24px;
	}
	#headimg img {
		max-width: <?php echo get_theme_support( 'custom-header', 'max-width' ); ?>px;
	}
	</style>
<?php
}


function nanodesigns_admin_header_image() {
	?>
	<div id="headimg">
		<?php
		if ( ! display_header_text() )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_header_textcolor() . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<h2 id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></h2>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }

