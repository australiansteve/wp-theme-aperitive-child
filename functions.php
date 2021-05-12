<?php

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Page Titles',
		'menu_title'	=> 'Page Titles',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}

add_action( 'wp_enqueue_scripts', function() {
 
    $parent_style = 'parent-style'; 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );

    wp_enqueue_script( 'font-awesome', 'https://kit.fontawesome.com/30900d1525.js');

    wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/js/main.js', array( 'jquery' ));

});

add_action( 'login_enqueue_scripts', function() { 
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
?>
    <style type="text/css">
    	body {
		    background: #d8d8d8 !important;
		}

        #login h1 a, .login h1 a {
            background-image: url(<?php echo $image[0]; ?>);
			height: 160px;
			width: 320px;
			background-size: 320px 160px;
			background-repeat: no-repeat;
        }
    </style>
<?php 
});

add_action( 'after_setup_theme', function() {
  register_nav_menu( 'about-page-menu', __( 'About Submenu', 'aperitive' ) );
  register_nav_menu( 'services-page-menu', __( 'Services Submenu', 'aperitive' ) );
  add_image_size( 'about-profile', 220, 220, array( 'center', 'center' ) );
  add_image_size( 'post-archive-featured', 260, 260, array( 'center', 'center' ) );
  add_image_size( 'footer-logo', 200, 98, array( 'center', 'center' ) );
});


function austeveFilterPageTitle( $title, $id = null ) {

    if (!in_the_loop())
    {
    	if (is_front_page())
    	{
			$title = get_field('front_page_title', 'option');

    	}
    	if (is_page_template('templates/about-page.php', $id ))
    	{
			$title = get_field('about_page_title', 'option');

    	}
    	else if (is_page_template('templates/services-page.php', $id )) {
			$title = get_field('services_page_title', 'option');

    	}
    	else if (is_page_template('templates/contact-page.php', $id )) {
			$title = get_field('contact_page_title', 'option');

    	}
    }

    return $title;
}
add_filter( 'the_title', 'austeveFilterPageTitle', 10, 2 );

/* Remove the_title filter before processing menus */
add_filter ('pre_wp_nav_menu', function ($nav_menu, $args ) {
	remove_filter( 'the_title', 'austeveFilterPageTitle', 10, 2 );
	return $nav_menu;
 
}, 10, 2);

/* Add the_title filter back after processing menus */
add_filter ('wp_nav_menu', function ($nav_menu, $args ) {
	add_filter( 'the_title', 'austeveFilterPageTitle', 10, 2 );
	return $nav_menu;
}, 10, 2);

/* Display Font Awesome icons in social menu */
add_filter('wp_nav_menu_objects', function( $items, $args ) {
	
	// loop
	foreach( $items as &$item ) {
		// vars
		$icon = get_field('font_awesome_icon', $item);
		
		// replace title with icon
		if( $icon ) {
			$title = $item->title;
			$item->title = '<span class="fa-stack"><i class="fas fa-circle fa-stack-2x"></i><i class="fab fa-'.$icon.' fa-stack-1x" title="'.$title.'"></i></span>';
			
		}
		
	}
	
	// return
	return $items;
	
}, 10, 2);


/* Stop admin notice about required/recommended plugins being displayed */
function austeve_remove_tgmpa_register(){
	//error_log("Remove TGMPA registration");
	remove_action( 'tgmpa_register', 'aperitive_register_slider_plugin' );
}
add_action( 'init', 'austeve_remove_tgmpa_register' );



/**
 * Remove parent theme filter and add own 'more' link text to excerpt
 */
function austeve_new_excerpt_more( $excerpt ) {

	global $post;
	return $excerpt . ' <p><a class="button moretag" href="'. get_permalink( $post->ID ) . '">' . esc_html__( 'Read more', 'aperitive' ) . '</a></p>';

}

function austeve_alter_read_more_buttons() {
	remove_filter( 'get_the_excerpt', 'aperitive_new_excerpt_more' ); //Parent theme filter
	add_filter( 'get_the_excerpt', 'austeve_new_excerpt_more' ); //Register new child theme filter
}

add_action( 'init', 'austeve_alter_read_more_buttons' );

// Adding excerpt for page
add_post_type_support( 'page', 'excerpt' );

add_action('wp_head', function() {

	$metaUrl = rtrim('http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], '/');
	$metaType = is_singular(array("post", "page")) ? 'article': 'website';
	$metaTitle = (is_home() ? get_the_title(get_option('page_for_posts', true)) : get_the_title()).' - '.get_bloginfo("name");
	$metaDescription = is_singular(array("post", "page")) ? wp_strip_all_tags(get_the_excerpt()) : get_field('facebook_default_description', 'option');
	$metaImgUrl = is_singular(array("post", "page")) && has_post_thumbnail() ? get_the_post_thumbnail_url() : get_field('facebook_default_image', 'option')['url'];

    ?>
    	<meta property="og:url"	content="<?php echo $metaUrl;?>" />
		<meta property="og:type" content="<?php echo $metaType;?>" />
		<meta property="og:title" content="<?php echo $metaTitle;?>" />
		<meta property="og:description" content="<?php echo $metaDescription;?>" />
		<meta property="og:image" content="<?php echo $metaImgUrl;?>" />
    <?php
});

/* Move Yoast metabox below ACF ones */
add_filter( 'wpseo_metabox_prio', function() {
    return 'low';
});

?>