<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.2.0
 */

// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
$self = isset( $this ) ? $this : false;
// phpcs:enable
if ( ! $self ) {
	return;
}

$instance = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$instance,
	// phpcs:enable
	[]
);

if ( ! $instance ) {
	return;
}
?>

<div class="snow-monkey-taxonomy-posts-widget">
	<p>
		<label for="<?php echo esc_attr( $self->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'snow-monkey' ); ?></label><br>
		<input
			type="text"
			name="<?php echo esc_attr( $self->get_field_name( 'title' ) ); ?>"
			id="<?php echo esc_attr( $self->get_field_id( 'title' ) ); ?>"
			class="widefat"
			value="<?php echo esc_attr( $instance['title'] ); ?>"
		>
	</p>

	<p>
		<?php
		$taxonomies = get_taxonomies(
			[
				'public'  => true,
				'show_ui' => true,
			],
			'names'
		);

		$all_terms = [];
		foreach ( $taxonomies as $_taxonomy ) {
			$all_terms[ $_taxonomy ] = get_terms(
				$_taxonomy,
				[
					'parent' => 0,
				]
			);
		}
		?>
		<label for="<?php echo esc_attr( $self->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Displayed term', 'snow-monkey' ); ?></label><br>
		<select
			name="<?php echo esc_attr( $self->get_field_name( 'taxonomy' ) ); ?>"
			id="<?php echo esc_attr( $self->get_field_id( 'taxonomy' ) ); ?>"
			class="widefat"
		>
			<option value=""></option>
			<?php foreach ( $all_terms as $taxonomy_id => $terms ) : ?>
				<optgroup label="<?php echo esc_attr( get_taxonomy( $taxonomy_id )->label ); ?>">
					<?php
					if ( ! function_exists( 'snow_monkey_taxonomy_posts_display_children' ) ) {
						/**
						 * Display options of select elements of the taxonomy
						 *
						 * @param int     $taxonomy_id The taxonomy ID.
						 * @param int     $term_id The term ID.
						 * @param boolean $saved_term Selected term.
						 * @param int     $hierarchy Hierarchy level.
						 * @return void
						 */
						function snow_monkey_taxonomy_posts_display_children( $taxonomy_id, $term_id, $saved_term, $hierarchy = 0 ) {
							$terms = get_terms(
								$taxonomy_id,
								[
									'parent' => $term_id,
								]
							);
							?>
							<?php foreach ( $terms as $term ) : ?>
								<?php $value = $taxonomy_id . '@' . $term->term_id; ?>
								<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $saved_term, $value ); ?>>
									<?php echo esc_html( str_repeat( '—', $hierarchy ) ); ?> <?php echo esc_html( $term->name ); ?>
								</option>
								<?php snow_monkey_taxonomy_posts_display_children( $taxonomy_id, $term->term_id, $saved_term, $hierarchy + 1 ); ?>
							<?php endforeach; ?>
							<?php
						}
					}
					snow_monkey_taxonomy_posts_display_children( $taxonomy_id, 0, $instance['taxonomy'] );
					?>
				</optgroup>
			<?php endforeach; ?>
		</select>
	</p>

	<p>
		<label for="<?php echo esc_attr( $self->get_field_id( 'posts-per-page' ) ); ?>"><?php esc_html_e( 'Number of posts', 'snow-monkey' ); ?></label><br>
		<input
			type="number"
			name="<?php echo esc_attr( $self->get_field_name( 'posts-per-page' ) ); ?>"
			id="<?php echo esc_attr( $self->get_field_id( 'posts-per-page' ) ); ?>"
			value="<?php echo esc_attr( $instance['posts-per-page'] ); ?>"
			step="1"
			min="1"
		>
	</p>

	<p>
		<label for="<?php echo esc_attr( $self->get_field_id( 'layout' ) ); ?>"><?php esc_html_e( 'Layout', 'snow-monkey' ); ?></label><br>
		<select
			name="<?php echo esc_attr( $self->get_field_name( 'layout' ) ); ?>"
			id="<?php echo esc_attr( $self->get_field_id( 'layout' ) ); ?>"
			class="widefat"
		>
			<?php
			$layouts = [
				'rich-media' => __( 'Rich media', 'snow-monkey' ),
				'simple'     => __( 'Simple', 'snow-monkey' ),
				'text'       => __( 'Text', 'snow-monkey' ),
				'text2'      => __( 'Text 2', 'snow-monkey' ),
				'panel'      => __( 'Panels', 'snow-monkey' ),
				'carousel'   => sprintf(
					// translators: %1$s: entries layout
					__( 'Carousel (%1$s)', 'snow-monkey' ),
					__( 'Rich media', 'snow-monkey' )
				),
			]
			?>
			<?php foreach ( $layouts as $value => $label ) : ?>
				<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, $instance['layout'], true ); ?>><?php echo esc_html( $label ); ?></option>
			<?php endforeach; ?>
		</select>
	</p>

	<p>
		<label for="<?php echo esc_attr( $self->get_field_id( 'link-url' ) ); ?>"><?php esc_html_e( 'Link URL', 'snow-monkey' ); ?></label><br>
		<input
			type="text"
			name="<?php echo esc_attr( $self->get_field_name( 'link-url' ) ); ?>"
			id="<?php echo esc_attr( $self->get_field_id( 'link-url' ) ); ?>"
			class="widefat"
			value="<?php echo esc_attr( $instance['link-url'] ); ?>"
		>
	</p>

	<p>
		<label for="<?php echo esc_attr( $self->get_field_id( 'link-text' ) ); ?>"><?php esc_html_e( 'Link text', 'snow-monkey' ); ?></label><br>
		<input
			type="text"
			name="<?php echo esc_attr( $self->get_field_name( 'link-text' ) ); ?>"
			id="<?php echo esc_attr( $self->get_field_id( 'link-text' ) ); ?>"
			class="widefat"
			value="<?php echo esc_attr( $instance['link-text'] ); ?>"
		>
	</p>

	<p>
		<input type="hidden" name="<?php echo esc_attr( $self->get_field_name( 'ignore-sticky-posts' ) ); ?>" value="0">
		<input
			type="checkbox"
			name="<?php echo esc_attr( $self->get_field_name( 'ignore-sticky-posts' ) ); ?>"
			id="<?php echo esc_attr( $self->get_field_id( 'ignore-sticky-posts' ) ); ?>"
			value="1"
			<?php checked( 1, $instance['ignore-sticky-posts'] ); ?>
		>
		<label for="<?php echo esc_attr( $self->get_field_id( 'ignore-sticky-posts' ) ); ?>"><?php esc_html_e( 'Ignore sticky posts', 'snow-monkey' ); ?></label>
	</p>
</div>
