<?php
/**
 * Christmas Sweets Theme Customizer -Icons
 *
 * @package Christmas Sweets
 */

/**
 * Enqueue the customizer stylesheet for our radio buttons.
 */
function christmas_sweets_customizer_icon_stylesheet() {
	wp_enqueue_style( 'christmas_sweets-customizer-css', get_template_directory_uri() . '/css/customizer.css' );
}
add_action( 'customize_controls_print_styles', 'christmas_sweets_customizer_icon_stylesheet' );

$sweets_icon_list = array( 'activity', 'art', 'category', 'chat', 'close', 'comment', 'day', 'document', 'edit', 'editor-video', 'ellipsis', 'heart', 'help', 'info', 'image', 'location', 'mail', 'microphone', 'paintbrush', 'standard', 'star-empty', 'wordpress', 'tree', 'present', 'decoration' );

/**
 * Register our customizer settings.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function christmas_sweets_customize_register_icon( $wp_customize ) {

	/**
	 * Custom control for our icons.
	 */
	class Christmas_Sweets_Icon_Control extends WP_Customize_Control {
		/**
		 * Create a fieldset, labels and radio buttons for our dashicons.
		 */
		public function render_content() {
			require get_template_directory() . '/images/svg-icons.svg';

			global $sweets_icon_list;

			?>
			<div class="sweets-radio-buttons">
				<fieldset>
					<legend class="customize-control-title"><?php echo esc_html( $this->label ); ?></legend>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php
					foreach ( $sweets_icon_list as &$value ) {
						?>
						<label>
						<?php echo '<span class="screen-reader-text">' . esc_html__( 'Icon name: ', 'christmas-sweets' ) . $value . '</span>'; ?>
						<?php echo christmas_sweets_get_svg( array( 'icon' => $value ) ); ?>
						<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $this->id ); ?>"
						<?php $this->link(); checked( $this->value(), $value ); ?> />
						</label>
						<?php
					}
					?>
				</fieldset>
			</div>
			<?php
		}
	}

	$wp_customize->add_setting(
		'christmas_sweets_footer_icon',
		array(
			'sanitize_callback' => 'christmas_sweets_validate_icons',
			'default'           => 'decoration',
		)
	);

	$wp_customize->add_control(
		new Christmas_Sweets_Icon_Control(
			$wp_customize,
			'christmas_sweets_footer_icon',
			array(
				'label'       => __( 'Custom Icon', 'christmas-sweets' ),
				'description' => __( 'The icon is displayed above the footer.', 'christmas-sweets' ),
				'section'     => 'christmas_sweets_options',
				'settings'    => 'christmas_sweets_footer_icon',
				'priority'    => 100,
			)
		)
	);

	$wp_customize->add_setting(
		'christmas_sweets_icon_color',
		array(
			'default'           => '#e82222',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'christmas_sweets_icon_color',
			array(
				'label'    => __( 'Icon color', 'christmas-sweets' ),
				'section'  => 'christmas_sweets_options',
				'settings' => 'christmas_sweets_icon_color',
				'priority' => 100,
			)
		)
	);

}
add_action( 'customize_register', 'christmas_sweets_customize_register_icon' );

/**
 * Validate the list of icons.
 */
function christmas_sweets_validate_icons( $input ) {
	global $sweets_icon_list;
	$input = sanitize_key( $input );
	return ( in_array( $input, $sweets_icon_list, true ) ? $input : 'wordpress' );
}
