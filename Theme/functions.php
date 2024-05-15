<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Davids_theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Version Number.
	define( '_S_VERSION', '1.0.0' );
}

function wordpress_theme_setup() {

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'wordpress_theme_setup' );

function wpb_custom_new_menu() {
	register_nav_menus(
	  array(
		'main-navigation' => __( 'Main Navigation' ),
		'footer-menu' => __( 'Footer Menu' )
	  )
	);
  }
  add_action( 'init', 'wpb_custom_new_menu' );

/**
 *
 * @global int $content_width
 */
function wordpress_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wordpress_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'wordpress_theme_content_width', 0 );

/**
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wordpress_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wordpress_theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wordpress_theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wordpress_theme_widgets_init' );

require get_template_directory() . '/inc/template-tags.php';

require get_template_directory() . '/inc/template-functions.php';

require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



/**
 * Register Custom Navigation Walker
 */

function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

//* Remove the prefix of 'Category:', 'Tag:' etc... from page title
add_filter( 'get_the_archive_title', function ($title) {    
	if ( is_category() ) {    
			$title = single_cat_title( '', false );    
		} elseif ( is_tag() ) {    
			$title = single_tag_title( '', false );    
		} elseif ( is_author() ) {    
			$title = '<span class="vcard">' . get_the_author() . '</span>' ;    
		} elseif ( is_tax() ) { //for custom post types
			$title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
		} elseif (is_post_type_archive()) {
			$title = post_type_archive_title( '', false );
		}
	return $title;    
});

add_filter( 'wp_nav_menu_objects', 'mytheme_menufilter', 10, 2 );
function mytheme_menufilter($items, $args) {
    if ( $args->theme_location == 'main-navigation' ) {
        $toplinks = 0;
        foreach ( $items as $k => $v ) {
            if ( $v->menu_item_parent == 0 ) {
                $toplinks++;
            }
            if ( $toplinks > 7 ) {
                unset($items[$k]);
            }
        }
    }
    return $items;
}

register_block_style(            
	'core/button',            
	 array(                
	   'name'  => 'download-btn',                
	   'label' => __( 'Download Link', 'wp-rig' ),            
	)        
  );

add_action('customize_register', 'add_header_warning');
function add_header_warning ($wp_customize) {
$wp_customize->add_setting ( 'header_warning', array(
	'default' => '',
	'capability' => 'edit_theme_options'
));
$wp_customize->add_control( 'header_warning', array(
	'label' => 'Header Warning',
	'section' => 'title_warning',
	'type' => 'text'
));
}
add_action('customize_register', 'add_second_tagline');
function add_second_tagline($wp_customize) {

	$wp_customize->add_setting( 'second_tagline', array(
	'default' => '',
	'capability' => 'edit_theme_options'
	) );
   
	$wp_customize->add_control( 'second_tagline', array(
	'label' => 'Header Warning',
	'section' => 'title_tagline',
	'type' => 'text'
	) );
   }