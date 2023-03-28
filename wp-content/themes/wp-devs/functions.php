<?php 

// cleaning header functions
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0 );
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');


// Adding stuff
function wpdevs_load_scripts(){

    // style.css
    wp_enqueue_style('wpdevs-style', get_stylesheet_uri(), array(), filemtime(get_template_directory() . '/style.css'), 'all');

    // google fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap', array(), null);

    // scripts
    wp_enqueue_script( 'dropdown', get_template_directory_uri() . '/js/dropdown.js', array(), '1.0', true );
}

add_action('wp_enqueue_scripts', 'wpdevs_load_scripts' );


function wpdevs_config() {
    // Menu
    register_nav_menus(
        array(
            'wp_devs_main_menu' => 'Main Menu',
            'wp_devs_footer_menu' => 'Footer Menu',
        )
    );

    // Theme support

    // Header image
    $args = array(
        'height' => 225,
        'width' => 1920
    );

    add_theme_support( 'custom-header', $args );

    // Post Thumbnails
    add_theme_support('post-thumbnails');

    // Custom logo
    add_theme_support( 'custom-logo', array(
        'width' => 200,
        'height'    => 110,
        'flex-height'   => true,
        'flex-width'    => true
    ) );

    // Title tag
    add_theme_support( 'title-tag' );

    // RSS
    add_theme_support('automatic-feed-links');

    // HTML5
    add_theme_support('html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ));
}

add_action('after_setup_theme', 'wpdevs_config', 0);

// Sidebars
add_action('widgets_init', 'wpdevs_sidebars');

function wpdevs_sidebars(){
    register_sidebar(
        array(
            'name' => 'Blog Sidebar',
            'id' => 'sidebar-blog',
            'description' => 'This is the Blog Sidebar. You can add ypur widgets here',
            'before_widget' => '<div class="widget-wrapper">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        )
    );

    register_sidebar(
        array(
            'name' => 'Service 1',
            'id' => 'services-1',
            'description' => 'First Service Area',
            'before_widget' => '<div class="widget-wrapper">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        )
    );

    register_sidebar(
        array(
            'name' => 'Service 2',
            'id' => 'services-2',
            'description' => 'Second Service Area',
            'before_widget' => '<div class="widget-wrapper">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        )
    );

    register_sidebar(
        array(
            'name' => 'Service 3',
            'id' => 'services-3',
            'description' => 'Third Service Area',
            'before_widget' => '<div class="widget-wrapper">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        )
    );

}

if( !function_exists( 'wp_body_open')) {
    function wp_body_open(){
        do_action('wp_body_open');
    }
}