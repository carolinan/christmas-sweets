<?php
/**
 * Template part for displaying posts and pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Christmas Sweets
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ( is_single() || is_page() ) {
		if ( has_post_thumbnail() ) {
			the_post_thumbnail();
		}
		?>
		<header class="entry-header">
		<?php
		the_title( '<h1 class="entry-title">', '</h1>' );
		?>
		</header><!-- .entry-header -->
		<?php if ( function_exists( 'jetpack_breadcrumbs' ) ) { ?>
			<span class="screen-reader-text"><?php esc_html_e( 'Breadcrumb Navigation', 'christmas-sweets' ); ?></span>
			<div class="breadcrumb-area"><?php jetpack_breadcrumbs(); ?></div><!-- .breadcrumb-area -->
		<?php } ?>

		<?php christmas_sweets_posted_on(); ?>

		<div class="entry-content">
			<?php
			the_content();

			wp_link_pages(
				array(
					'before'      => '<div class="page-links">' . __( 'Pages:', 'christmas-sweets' ),
					'after'       => '</div>',
					'link_before' => '<span class="page-number">',
					'link_after'  => '</span>',
				)
			);
			?>
		</div><!-- .entry-content -->
		<footer class="entry-footer">
		<?php christmas_sweets_entry_footer(); ?>
		</footer><!-- .entry-footer -->
		<?php
	} else {
		if ( has_post_thumbnail() ) {
			echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
			the_post_thumbnail();
			echo '</a>';
		}
		?>
		<header class="entry-header">
		<?php
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		?>
		</header><!-- .entry-header -->
		<?php
		if ( get_theme_mod( 'christmas_sweets_show_meta' ) ) {
			christmas_sweets_posted_on();
		}
		?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
		<?php
	}
	?>

</article><!-- #post-## -->
