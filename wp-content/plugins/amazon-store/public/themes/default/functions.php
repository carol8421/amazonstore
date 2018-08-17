<?php 
function amazonEnqueStyles()
{
	wp_enqueue_style( BBIL_AMAZON_NAME.'-bootstrap', BBIL_THEME_DIR . 'css/bootstrap.min.css', array(), BBIL_AMAZON_VERSION, 'all' );
	wp_enqueue_style( BBIL_AMAZON_NAME.'-jquery_ui', BBIL_THEME_DIR . 'css/jquery-ui.min.css', array(), BBIL_AMAZON_VERSION, 'all' );
	wp_enqueue_style( BBIL_AMAZON_NAME.'-jquery_ui_theme', BBIL_THEME_DIR . 'css/jquery-ui.theme.min.css', array(), BBIL_AMAZON_VERSION, 'all' );

	wp_enqueue_style( BBIL_AMAZON_NAME.'-ubuntu', 'https://fonts.googleapis.com/css?family=Ubuntu', array(), BBIL_AMAZON_VERSION, 'all' );
	wp_enqueue_style( BBIL_AMAZON_NAME.'-pacifico', 'https://fonts.googleapis.com/css?family=Pacifico', array(), BBIL_AMAZON_VERSION, 'all' );
	wp_enqueue_style( BBIL_AMAZON_NAME.'-font_awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), BBIL_AMAZON_VERSION, 'all' );

	wp_enqueue_style( BBIL_AMAZON_NAME.'-HoldOn', BBIL_THEME_DIR . 'css/HoldOn.min.css', array(), BBIL_AMAZON_VERSION, 'all' );

	wp_enqueue_style( BBIL_AMAZON_NAME.'-common', BBIL_THEME_DIR . 'css/common-styles.css', array(), BBIL_AMAZON_VERSION, 'all' );
	wp_enqueue_style( BBIL_AMAZON_NAME.'-style', BBIL_THEME_DIR . 'css/style.css', array(), BBIL_AMAZON_VERSION, 'all' );
	wp_enqueue_style( BBIL_AMAZON_NAME.'default_styles', BBIL_THEME_DIR . 'css/default_styles.css', array(), BBIL_AMAZON_VERSION, 'all' );
	wp_enqueue_style( BBIL_AMAZON_NAME.'-mediaquery', BBIL_THEME_DIR . 'css/mediaquery.css', array(), BBIL_AMAZON_VERSION, 'all' );

	wp_enqueue_style( BBIL_AMAZON_NAME, BBIL_THEME_DIR . 'css/bbil-amazon-product-public.css', array(), BBIL_AMAZON_VERSION, 'all' );
}
function amazonEnqueScripts()
{
	wp_enqueue_script( BBIL_AMAZON_NAME.'-jquery_ui', BBIL_THEME_DIR . 'js/jquery-ui.min.js', array('jquery'), BBIL_AMAZON_VERSION, false );
	wp_enqueue_script( BBIL_AMAZON_NAME.'-bootstrap', BBIL_THEME_DIR . 'js/bootstrap.min.js', array('jquery'), BBIL_AMAZON_VERSION, false );
	wp_enqueue_script( BBIL_AMAZON_NAME.'-masonry', 'https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', array('jquery'), BBIL_AMAZON_VERSION, false );
	wp_enqueue_script( BBIL_AMAZON_NAME.'-elevateZoom', BBIL_THEME_DIR . 'js/elevatezoom.min.js', array('jquery'), BBIL_AMAZON_VERSION, false );
	wp_enqueue_script( BBIL_AMAZON_NAME.'-custom', BBIL_THEME_DIR . 'js/custom.js', array('jquery'), BBIL_AMAZON_VERSION, false );
	wp_enqueue_script( BBIL_AMAZON_NAME.'-HoldOn', BBIL_THEME_DIR . 'js/HoldOn.min.js', array('jquery'), BBIL_AMAZON_VERSION, false );

	wp_enqueue_script( BBIL_AMAZON_NAME, BBIL_THEME_DIR . 'js/bbil-amazon-product-public.js', array('jquery'), BBIL_AMAZON_VERSION, false );
}