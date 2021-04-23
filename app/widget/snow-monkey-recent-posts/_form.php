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

<div class="snow-monkey-recent-posts-widget">
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
		<label for="<?php echo esc_attr( $self->get_field_id( 'post-type' ) ); ?>"><?php esc_html_e( 'Post type', 'snow-monkey' ); ?></label><br>
		<select
			name="<?php echo esc_attr( $self->get_field_name( 'post-type' ) ); ?>"
			id="<?php echo esc_attr( $self->get_field_id( 'post-type' ) ); ?>"
			class="widefat"
		>
			<?php
			$post_types = get_post_types(
				[
					'public'       => true,
					'show_ui'      => true,
					'hierarchical' => false,
				],
				'objects'
			);
			unset( $post_types['attachment'] );
			?>
			<?php foreach ( $post_types as $_post_type ) : ?>
				<option value="<?php echo esc_attr( $_post_type->name ); ?>" <?php selected( $_post_type->name, $instance['post-type'] ); ?>>
					<?php echo esc_html( $_post_type->label ); ?>
				</option>
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
