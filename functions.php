<?php
/**
 * Christmas Sweets functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Christmas Sweets
 */

if ( ! function_exists( 'christmas_sweets_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function christmas_sweets_setup() {
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );

		add_image_size( 'christmas-sweets-recent-post', 80, 80 );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 60,
				'width'       => 200,
				'flex-height' => true,
				'flex-width'  => true,
				'header-text' => array( 'site-title', 'site-description' ),
			)
		);

		register_nav_menus(
			array(
				'main'   => esc_html__( 'Main Menu (Header)', 'christmas-sweets' ),
				'social' => esc_html__( 'Social Menu (Footer)', 'christmas-sweets' ),
			)
		);

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		add_theme_support(
			'custom-header',
			apply_filters(
				'christmas_sweets_custom_header_args',
				array(
					'default-image'      => get_template_directory_uri() . '/images/pepparkaka.png',
					'default-text-color' => 'e82222',
					'uploads'            => true,
					'width'              => '400',
					'height'             => '110',
					'flex-height'        => true,
					'flex-width'         => true,
					'video'              => false,
				)
			)
		);

		register_default_headers(
			array(
				'default' => array(
					'url'           => get_stylesheet_directory_uri() . '/images/pepparkaka.png',
					'thumbnail_url' => get_stylesheet_directory_uri() . '/images/pepparkaka.png',
				),
			)
		);

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'jetpack-responsive-videos' );

		add_theme_support( 'woocommerce' );

		add_theme_support(
			'starter-content',
			array(
				'nav_menus' => array(
					'main'  => array(
						'name'  => __( 'Main Menu (Header)', 'christmas-sweets' ),
						'items' => array(
							'page_about',
							'page_contact',
						),
					),
					'social' => array(
						'name'  => __( 'Social Menu (Footer)', 'christmas-sweets' ),
						'items' => array(
							'link_facebook',
							'link_twitter',
							'link_instagram',
						),
					),
				),
				'posts' => array(
					'about',
					'contact',
					'blog',
					'news',
				),

			)
		);

		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Christmas red', 'christmas-sweets' ),
					'slug'  => 'christmas-sweets-red',
					'color' => '#e82222',
				),
			)
		);

		add_theme_support( 'responsive-embeds' );

	}
}

add_action( 'after_setup_theme', 'christmas_sweets_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function christmas_sweets_content_width() {
	// We are setting this to 700, which will match the Gutenberg editor.
	$GLOBALS['content_width'] = apply_filters( 'christmas_sweets_content_width', 700 );
}
add_action( 'after_setup_theme', 'christmas_sweets_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function christmas_sweets_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets', 'christmas-sweets' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Widgets in this section will be shown in the footer.', 'christmas-sweets' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Copyright', 'christmas-sweets' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Please place a single text widget with your copyright information here. It will then be shown in the footer.', 'christmas-sweets' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Shop Widgets', 'christmas-sweets' ),
				'id'            => 'sidebar-shop',
				'description'   => esc_html__( 'Widgets in this section will be shown below your shop.', 'christmas-sweets' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}

}
add_action( 'widgets_init', 'christmas_sweets_widgets_init' );

/**
 * Register custom fonts.
 * Credits:
 * Twenty Seventeen WordPress Theme, Copyright 2016 WordPress.org
 * Twenty Seventeen is distributed under the terms of the GNU GPL
 */
function christmas_sweets_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Ledger, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$noto = _x( 'on', 'Noto Serif font: on or off', 'christmas-sweets' );
	$christmas = _x( 'on', 'Mountains of Christmas font: on or off', 'christmas-sweets' );

	if ( 'off' !== $noto || 'off' !== $christmas ) {
		$font_families = array();
	}

	if ( 'off' !== $noto ) {
		$font_families[] = 'Noto Serif';
	}

	if ( 'off' !== $christmas ) {
		$font_families[] = 'Mountains of Christmas';
	}

	$query_args = array(
		'family' => rawurlencode( implode( '|', $font_families ) ),
		'subset' => rawurlencode( 'latin,latin-ext' ),
	);

	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function christmas_sweets_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'christmas-sweets-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'christmas_sweets_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function christmas_sweets_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'christmas-sweets-fonts', christmas_sweets_fonts_url(), array(), null );
	wp_enqueue_style( 'christmas-sweets-style', get_stylesheet_uri() );

	wp_enqueue_script( 'christmas-sweets-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20170910', true );
	wp_enqueue_script( 'christmas-sweets-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20170910', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'christmas_sweets_scripts' );

if ( ! function_exists( 'christmas_sweets_gutenberg_assets' ) ) {
	/**
	 * Add styles and fonts for the new editor.
	 */
	function christmas_sweets_gutenberg_assets() {
		wp_enqueue_style( 'christmas_sweets-gutenberg', get_theme_file_uri( '/css/gutenberg-editor.css' ), false );
	}
	add_action( 'enqueue_block_editor_assets', 'christmas_sweets_gutenberg_assets' );
}

/**
 * Adjust the comment excerpt length
 */
function christmas_sweets_excerpt_length( $length ) {
	if ( ! is_admin() ) {
		global $wp_query;
		if ( $wp_query->current_post === 0 && ! is_paged() && ! is_archive() ) {
			return 150;
		} else {
			return 40;
		}
	} else {
		return $length;
	}
}
add_filter( 'excerpt_length', 'christmas_sweets_excerpt_length', 999 );

/**
 * Adjust the continue reading.
 */
function christmas_sweets_excerpt_more( $more ) {
	global $post;
	global $wp_query;
	if ( $wp_query->current_post === 0 && ! is_paged() ) {
		return '&hellip; <br><br><a class="more-link" href="' . esc_url( get_permalink( $post->ID ) ) . '">' .
		sprintf( esc_html__( 'Continue Reading %s', 'christmas-sweets' ), get_the_title( $post->ID ) ) . '</a>';
	} else {
		return '&hellip; ';
	}
}
add_filter( 'excerpt_more', 'christmas_sweets_excerpt_more' );

/**
 * Adjust the comment excerpt length
 */
function christmas_sweets_comment_excerpt_length( $length ) {
	if ( ! is_admin() ) {
		return 10;
	} else {
		return $length;
	}
}
add_filter( 'comment_excerpt_length', 'christmas_sweets_comment_excerpt_length', 999 );

if ( ! function_exists( 'christmas_sweets_comments_pagination' ) ) {
	/**
	 * Because get_the_comments_pagination() only accepts one type (plain) I had to alter the function slightly to add the list type,
	 * so that the comment pagination could be styled in the same way as the post pagination.
	 * https://developer.wordpress.org/reference/functions/get_the_comments_pagination/
	 * Related ticket: https://core.trac.wordpress.org/ticket/39792
	 **/
	function christmas_sweets_comments_pagination( $args = array() ) {
		$navigation = '';
		$args       = wp_parse_args( $args, array(
			'screen_reader_text' => __( 'Comments navigation', 'christmas-sweets' ),
			'prev_text'          => _x( 'Previous Comments', 'previous set of comments', 'christmas-sweets' ),
			'next_text'          => _x( 'Next Comments', 'next set of comments', 'christmas-sweets' ),
			'type'               => 'list',
		) );
		$links = paginate_comments_links( $args );
		if ( $links ) {
			$navigation = _navigation_markup( $links, 'comments-pagination', $args['screen_reader_text'] );
		}
	}
}

/**
 * Remove the Jetpack likes and sharing_display filter so that we can resposition them to our post footer.
 * Otherwise, they are displayed below the content, but above the page links ( wp_link_pages() ) if a post has multiple pages.
 */
function christmas_sweets_move_share() {
	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );

	if ( class_exists( 'Jetpack_Likes' ) ) {
		remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
	}
}
add_action( 'loop_start', 'christmas_sweets_move_share' );

/**
 * Remove the Jetpack related posts filter so that we can resposition them to our post footer.
 */
function christmas_sweets_move_related_posts() {
	if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
		$jprp = Jetpack_RelatedPosts::init();
		$callback = array( $jprp, 'filter_add_target_to_dom' );
		remove_filter( 'the_content', $callback, 40 );
	}
}
add_filter( 'wp', 'christmas_sweets_move_related_posts', 20 );

/**
 * Credit: Twenty Seventeen and Weston Ruter https://github.com/WordPress/gutenberg/issues/2235
 */
function christmas_sweets_body_classes( $body_classes ) {
	if ( is_singular() && false !== strpos( get_queried_object()->post_content, '<!-- wp:' ) ) {
		$body_classes[] = 'gutenberg';
	}
	if ( has_header_image() ) {
		$body_classes[] = 'has-header-media';
	}
	return $body_classes;
}
add_filter( 'body_class', 'christmas_sweets_body_classes' );

/**
 * Custom CSS for the theme options.
 */
function christmas_sweets_customize_css() {
	echo '<style type="text/css">';
	echo '.site-title, .site-title a, .site-description {color: #' . esc_attr( get_theme_mod( 'header_textcolor', 'e82222' ) ) . ';} 
		.site-description .icon {fill: #' . esc_attr( get_theme_mod( 'header_textcolor', 'e82222' ) ) . ';}
		.sweets-icon .icon {fill: ' . esc_attr( get_theme_mod( 'christmas_sweets_icon_color', '#e82222' ) ) . ';}';
	echo '</style>';
}
add_action( 'wp_head', 'christmas_sweets_customize_css' );

/* Add better support for WooCommerce */
if ( class_exists( 'WooCommerce' ) ) {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

	add_action( 'woocommerce_before_main_content', 'christmas_sweets_wrapper_start', 10 );
	add_action( 'woocommerce_after_main_content', 'christmas_sweets_wrapper_end', 10 );

	function christmas_sweets_wrapper_start() {
		echo '<main id="main" class="site-main">';
	}
	function christmas_sweets_wrapper_end() {
		echo '</main>';
	}
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/customizer-icons.php';
require get_template_directory() . '/inc/class-customize.php';

/**
 * SVG icons
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Load custom widget files.
 */
require get_template_directory() . '/inc/recent-posts-widget.php';
require get_template_directory() . '/inc/recent-comments-widget.php';
