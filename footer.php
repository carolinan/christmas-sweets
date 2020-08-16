<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Christmas Sweets
 */

?>
<footer id="colophon" role="contentinfo" class="site-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
	<?php
	echo '<div class="sweets-icon"><a href="' . esc_url( home_url( '/' ) ) . '"><span class="screen-reader-text">' . esc_html__( 'Return Home', 'christmas-sweets' ) . '</span>' . christmas_sweets_get_svg( array( 'icon' => get_theme_mod( 'christmas_sweets_footer_icon', 'decoration' ) ) ) . '</a></div>';
	?>
	<h2 class="screen-reader-text"><?php esc_html_e( 'Footer Content', 'christmas-sweets' ); ?></h2>
	<?php
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		?>
		<aside class="widget-area" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</aside>
		<?php
	}
	if ( has_nav_menu( 'social' ) ) {
		?>
		<nav class="social-menu" role="navigation" aria-label="<?php esc_attr_e( 'Social Media Links', 'christmas-sweets' ); ?>" 
		itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'social',
				'menu_class'     => 'social-links-menu',
				'depth'          => 1,
				'link_before'    => '<span class="screen-reader-text">',
				'link_after'     => '</span>' . christmas_sweets_get_svg( array( 'icon' => 'chain' ) ),
				'container'      => false,
			)
		);
		?>
		</nav><!-- #social-menu -->
		<?php
	}
	?>
	<div class="site-info">
	<?php
	if ( is_active_sidebar( 'sidebar-2' ) ) {
		?>
		<aside class="widget-area" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</aside>
		<?php
	}

	if ( function_exists( 'the_privacy_policy_link' ) ) {
		the_privacy_policy_link();
	}

	if ( ! get_theme_mod( 'christmas_sweets_hide_credits' ) ) {
		?>
		<div class="credits">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'christmas-sweets' ) ); ?>" class="credit"><?php printf( esc_html__( 'Proudly powered by %s', 'christmas-sweets' ), 'WordPress' ); ?></a>
			&nbsp; &nbsp;
			<a href="<?php echo esc_url( 'https://themesbycarolina.com' ); ?>" rel="nofollow" class="theme-credit"><?php printf( esc_html__( 'Theme: %1$s by Carolina', 'christmas-sweets' ), 'Christmas Sweets' ); ?></a>
		</div>
		<?php
	}
	?>
	</div><!-- .site-info -->

</footer><!-- #colophon -->
</div><!-- #page -->
<div class="bottom"></div>
<?php wp_footer(); ?>
</body>
</html>
