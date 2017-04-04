<?php
// Theme prefix
	global $themePrefix;
	$themePrefix = "_vhs_";

// Define templateurl
	define('TEMPLATEURL', get_template_directory_uri());

// Make theme available for translation
	load_theme_textdomain( 'lang', TEMPLATEPATH . '/languages' );

// Location defaults
	date_default_timezone_set( 'America/Sao_Paulo' );
	setlocale( LC_ALL, 'pt_BR' );
	define( 'CHARSET', 'utf-8' );

// Set content width
	if(!isset($content_width)) $content_width = 640;

// Register navigation menus
	add_theme_support('nav-menus');
	register_nav_menus( array( 
			'menu'	=> 'Main', 
			'footer'=> 'Footer' 
		) 
	);

// Register post thumbnail sizes
	add_theme_support( 'post-thumbnails', array( 'noticias', 'eventos', 'estabelecimentos' ) );
	set_post_thumbnail_size( 1920, 1080 );
	add_image_size( $themePrefix . 'fullWidth', 1140, 'center' );
	add_image_size( $themePrefix . 'homeSlider', 850, 315, 'center' );
	add_image_size( $themePrefix . 'singleThumbnail', 850, 500, false );
	add_image_size( $themePrefix . 'contentSize', 555, 315, 'center' );
	add_image_size( $themePrefix . 'postListFirst', 360, 205, 'center' );
	add_image_size( $themePrefix . 'postList', 265, 150, 'center' );
	add_image_size( $themePrefix . '1BannerSize', 250, 600 );
	add_image_size( $themePrefix . 'smallList', 85, 48, 'center' );

// Enqueue scripts
	add_action( 'wp_enqueue_scripts', 'vhs_enqueue_scripts' );
	function vhs_enqueue_scripts(){

		// Js files
		wp_enqueue_script( 'jquery');
		wp_enqueue_script( 'bootstrap.min', get_template_directory_uri().'/assets/js/bootstrap.min.js', array('jquery'), '', true);
		wp_enqueue_script( 'jquery.magnific-popup.min', get_template_directory_uri().'/assets/js/jquery.magnific-popup.min.js', array('jquery'), '', true);
		wp_enqueue_script( 'owl.carousel', get_template_directory_uri().'/assets/js/owl.carousel.min.js', array('jquery'), '', true);
		wp_enqueue_script( 'moment.min', get_template_directory_uri().'/assets/js/moment.min.js', array('jquery'), '', true);
		wp_enqueue_script( 'simpleWeather', get_template_directory_uri().'/assets/js/jquery.simpleWeather.min.js', array('jquery'), '', true);
		wp_enqueue_script( 'jquery.sticky-kit.min', get_template_directory_uri().'/assets/js/jquery.sticky-kit.min.js', array('jquery'), '', true);
		wp_enqueue_script( 'jquery.easy-ticker.min', get_template_directory_uri().'/assets/js/jquery.easy-ticker.min.js', array('jquery'), '', true);
		wp_enqueue_script( 'jquery.subscribe-better.min', get_template_directory_uri().'/assets/js/jquery.subscribe-better.min.js', array('jquery'), '', true);
		wp_enqueue_script( 'main', get_template_directory_uri().'/assets/js/main.js', array('jquery'), '', true);
		wp_enqueue_script( 'switcher', get_template_directory_uri().'/assets/js/switcher.js', array('jquery'), '', true);
		
		// Stylesheets files
		wp_enqueue_style( 'animate', get_template_directory_uri().'/assets/css/animate.css' );
		wp_enqueue_style( 'bootstrap.min', get_template_directory_uri().'/assets/css/bootstrap.min.css' );
		wp_enqueue_style( 'font-awesome.min', get_template_directory_uri().'/assets/css/font-awesome.min.css' );
		wp_enqueue_style( 'ionicons.min', get_template_directory_uri().'/assets/css/ionicons.min.css' );
		wp_enqueue_style( 'magnific-popup', get_template_directory_uri().'/assets/css/magnific-popup.css' );
		wp_enqueue_style( 'main', get_template_directory_uri().'/assets/css/main.css' );
		wp_enqueue_style( 'owl.carousel', get_template_directory_uri().'/assets/css/owl.carousel.css' );
		wp_enqueue_style( 'responsive', get_template_directory_uri().'/assets/css/responsive.css' );
		wp_enqueue_style( 'subscribe-better', get_template_directory_uri().'/assets/css/subscribe-better.css' );
	} 

// Admin extensions
	$extensions_path = TEMPLATEPATH . '/extensions/';
	if( file_exists( $extensions_path . 'custom-post-types.php' ) ) require_once( $extensions_path . 'custom-post-types.php' );
	if( file_exists( $extensions_path . 'custom-post-taxonomies.php' ) ) require_once( $extensions_path . 'custom-post-taxonomies.php' );
	if( file_exists( $extensions_path . 'custom-functions.php' ) ) require_once( $extensions_path . 'custom-functions.php' );
	if( file_exists( $extensions_path . 'custom-wordpress-tweeks.php' ) ) require_once( $extensions_path . 'custom-wordpress-tweeks.php' );
	if( file_exists( $extensions_path . 'tax-meta-class/tax-meta-class.php' ) ) require_once( $extensions_path . 'tax-meta-class/tax-meta-class.php' );
	if( file_exists( $extensions_path . 'custom-term-meta.php' ) ) require_once( $extensions_path . 'custom-term-meta.php' );

// Custom theme options
	if( ! class_exists( 'ReduxFramework' ) && file_exists( $extensions_path . 'redux/framework.php' ) ) require_once( $extensions_path . 'redux/framework.php' );
	if( file_exists( $extensions_path . 'custom-theme-options.php' ) ) require_once( $extensions_path . 'custom-theme-options.php' );

// Custom metaboxes
	add_action('init', 'vhs_admin_init');
	function vhs_admin_init(){
		$extensions_path = TEMPLATEPATH . '/extensions/';
		if( file_exists( $extensions_path . 'custom-metaboxes/init.php' ) ) require_once( $extensions_path . 'custom-metaboxes/init.php' );
	}
	if( file_exists( $extensions_path . 'custom-post-meta.php' ) ) require_once( $extensions_path . 'custom-post-meta.php' );
?>