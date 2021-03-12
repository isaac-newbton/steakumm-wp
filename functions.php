<?php
/**
 * Steak-Umm functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Steak-Umm
 */

if ( ! defined( '_S_VERSION' ) ) {
    // Replace the version number of the theme on each release.
    define( '_S_VERSION', '1.0.6' );
}
if ( ! function_exists( 'steak_umm_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function steak_umm_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Steak-Umm, use a find and replace
		 * to change 'steak-umm' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'steak-umm', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-primary' => esc_html__( 'Primary', 'steak-umm' ),
                'menu-social' => esc_html__( 'Social', 'steak-umm' ),
                'menu-footer' => esc_html__( 'Footer', 'steak-umm' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
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

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'steak_umm_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
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
endif;
add_action( 'after_setup_theme', 'steak_umm_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function steak_umm_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'steak_umm_content_width', 640 );
}
add_action( 'after_setup_theme', 'steak_umm_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
//function steak_umm_widgets_init() {
//	register_sidebar(
//		array(
//			'name'          => esc_html__( 'Sidebar', 'steak-umm' ),
//			'id'            => 'sidebar-1',
//			'description'   => esc_html__( 'Add widgets here.', 'steak-umm' ),
//			'before_widget' => '<section id="%1$s" class="widget %2$s">',
//			'after_widget'  => '</section>',
//			'before_title'  => '<h2 class="widget-title">',
//			'after_title'   => '</h2>',
//		)
//	);
//}
//add_action( 'widgets_init', 'steak_umm_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function steak_umm_scripts() {
    wp_enqueue_script('jquery-3-4-1', 'https://13f62bab5f8804072838-92c4eb9192a7668507938ec730b74ee0.ssl.cf5.rackcdn.com/CDN/jquery-3.4.1.min.js');

    wp_enqueue_script( 'fontawesome', get_template_directory_uri() . '/js/vendor/all.js');

	wp_enqueue_style( 'steak-umm-style', get_stylesheet_uri(), array(), _S_VERSION );

	wp_enqueue_script( 'steak-umm-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'steak_umm_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Set open graph meta tags
 */
function opengraph_meta_tags() {
    $pid = get_the_ID();
    $type = get_post_type($pid);
    $tags = array(
        'site_name' => get_bloginfo('name'),
        'url' => '',
        'title' => '',
        'description' => '',
        'image' => '',
        'type' => 'website'
    );
    if (is_archive()) {
        $tags['description'] = get_the_archive_description();
        $tags['title'] = get_the_archive_title();
    } else {
        if ($type == 'post' || $type == 'page') {
            $tags['image'] = get_the_post_thumbnail_url($pid);
            $tags['url'] = get_the_permalink($pid);
            $tags['title'] = get_the_title($pid);
        }
    }
    if ($tags['image'] == '') {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
        $tags['image'] = $image[0];
    }
    foreach($tags as $tagName => $tagValue) {
        if ($tagValue) {
            echo '<meta property="og:'.$tagName.'" content="'.$tagValue.'" />';
        }
    }
    echo '<meta name="twitter:card" content="summary">';
    echo '<meta name="twitter:url" content="'.$tags['url'].'">';
    echo '<meta name="twitter:title" content="'.$tags['title'].'">';
    echo '<meta name="twitter:description" content="'.$tags['description'].'">';
    echo '<meta name="twitter:image" content="'.$tags['image'].'">';

}
add_action( 'wp_head', 'opengraph_meta_tags' );

// register product and recipe type posts
function post_type_setup() {
    register_post_type('product', array(
        'label' => 'Products',
        'labels' => array(
            'name' => 'Products',
            'singular_name' => 'Product',
            'featured_image' => 'Product Image',
            'archives' => 'Products',
        ),
        'rewrite' => array(
            'slug' => 'products',
            'with_front' => true,
        ),
        'public' => true,
        'publicly_queryable' => true,
        'has_archive' => 'products',
        'menu_position' => 5,
        'menu-icon' => 'dashicons-products',
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'revisions'
        ),
    ));

    register_taxonomy(
        'meal',
        'recipe',
        array(
            'label' => 'Meals',
            'labels' => array(
                'name' => 'Meals',
                'singular_name' => 'Meal',
                'menu-name' => 'Meals',
                'all_items' => 'All Meals',
                'edit_item' => 'Edit Meals',
                'view_item' => 'View Meal',
                'update_item' => 'Update Meal',
                'add_new_item' => 'Add New Meal',
                'new_item_name' => 'New Meal Name',
                'parent_item' => 'Parent Meal',
                'search_items' => 'Search Meals',
                'not_found' => 'Meals Not Found',
                'choose_from_most_used' => 'Choose from the most used Meals',
            ),
            'public' => true,
            'publicly_queryable' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
        )
    );

    register_post_type('recipe', array(
        'label' => 'Recipes',
        'labels' => array(
            'name' => 'Recipes',
            'singular_name' => 'Recipe',
            'featured_image' => 'Recipe Image',
            'archives' => 'Recipes',
        ),
        'rewrite' => array(
            'slug' => 'recipes',
            'with_front' => true,
        ),
        'taxonomies' => array('tags'),
        'public' => true,
        'publicly_queryable' => true,
        'has_archive' => 'recipes',
        'menu_position' => 5,
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'revisions'
        ),
    ));
    register_taxonomy_for_object_type( 'meal', 'recipe' );
}
add_action( 'init', 'post_type_setup' );

// remove prepends from category and tag pages
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    }
    return $title;
});


// function and action to order recipes alphabetically
function alpha_order_recipes( $query ) {
    if ($query->is_post_type_archive('recipe') && $query->is_main_query() ) {
        $query->set( 'posts_per_page', '12' );
        $query->set( 'orderby', 'title' );
        $query->set( 'order', 'ASC' );
    }
    return $query;
}
add_action( 'pre_get_posts', 'alpha_order_recipes' );

// add related product search to recipe search
function recipe_search( $query ) {
    if ( !is_admin() && $query->is_search &&  is_post_type_archive('recipe')) {
        $query->set('meta_key', 'related_product');
        $query->set('meta_value', $_GET['related_product']);
        $query->set('meta_compare', 'IN');
    };
    return $query;
}
add_filter( 'pre_get_posts', 'recipe_search');

// Social Feed Gutenburg block
add_action('acf/init', 'custom_acf_blocks');
function custom_acf_blocks() {
    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a social block
        acf_register_block(array(
            'name'				=> 'social-feed-block',
            'title'				=> __('Social Feed'),
            'description'		=> __('Social media links displayed in a grid'),
            'render_callback'	=> 'my_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'admin-comments',
            'keywords'			=> array( 'social' ),
        ));

        // register a store block
        acf_register_block(array(
            'name'				=> 'store-feed-block',
            'title'				=> __('Store'),
            'description'		=> __('Images with links to store items'),
            'render_callback'	=> 'my_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'admin-comments',
            'keywords'			=> array( 'store' ),
        ));
    }
}

function my_acf_block_render_callback( $block ) {

    // convert name ("acf/social-feed-block") into path friendly slug ("social-feed-block")
    $slug = str_replace('acf/', '', $block['name']);

    // include a template part from within the "template-parts/block" folder
    if( file_exists( get_theme_file_path("/template-parts/block/content-{$slug}.php") ) ) {
        include( get_theme_file_path("/template-parts/block/content-{$slug}.php") );
    }
}

/**
 * REMOVE IN PRODUCTION
 */
//flush_rewrite_rules( false );
