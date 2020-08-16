<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Christmas Sweets
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php
	if ( have_comments() ) {
		?>
		<h2 class="entry-title">
			<?php
			$comment_count = get_comments_number();
			if ( 1 === $comment_count ) {
				printf(
					/* translators: %s: title */
					esc_html_x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'christmas-sweets' ),
					get_the_title()
				);
			} else {
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s Reply to &ldquo;%2$s&rdquo;', '%1$s Replies to &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'christmas-sweets' ) ),
					number_format_i18n( $comment_count ),
					get_the_title()
				);
			}
			?>
		</h2>
		<?php christmas_sweets_comments_pagination(); ?>	
		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
				'style' => 'ol',
				'avatar_size' => '40',
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		christmas_sweets_comments_pagination();

	} // End if().

	comment_form();
	?>

</div><!-- #comments -->
