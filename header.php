<?php
/**
 * The header of nano blogger
 *
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
    <title>	<?php wp_title('',true,'right'); ?></title>
        
        <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
        
        <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
        
        <link rel="alternate" type="application/rss+xml" href="<?php get_feed_link( 'rss2_url' ); ?>" title="<?php printf( __( '%s latest posts', 'nano-blogger' ), esc_html( get_bloginfo('name'), 1 ) ); ?>" />
        <link rel="alternate" type="application/rss+xml" href="<?php get_feed_link( 'comments_rss2_url'); ?>" title="<?php printf( __( '%s latest comments', 'nano-blogger' ), esc_html( get_bloginfo('name'), 1 ) ); ?>" />
        <link rel="pingback" href="<?php get_feed_link( 'pingback_url'); ?>" />
        
        <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper" class="hfeed">

        <header id="branding" role="banner">
        
		<hgroup>
			<h1 id="blog-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
			<?php if ( is_home() || is_front_page() ) { ?>
                <h1 id="blog-description"><?php bloginfo( 'description' ) ?></h1>
            <?php } else { ?>       
                <div id="blog-description"><?php bloginfo( 'description' ) ?></div>
            <?php } ?>
		</hgroup>
        
        <div class="sec-menu">
			<?php wp_nav_menu ( array ( 'theme_location'=>'secondary', 'fallback_cb'=>'') ); ?>
		</div>

		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?>
        
        <div id="access">
                <div class="skip-link"><a href="#content" title="<?php _e( 'Skip to content', 'nano-blogger' ) ?>"><?php _e( 'Skip to content', 'nano-blogger' ) ?></a></div>
                <div class="main-menu">
                    <?php wp_nav_menu ( array ( 'theme_location'=>'primary', 'fallback_cb'=>'') ); ?>
                </div>
        </div><!-- #access -->
        
	</header><!-- #branding -->
        
	<div class="clear"></div>
        
	<div id="main">