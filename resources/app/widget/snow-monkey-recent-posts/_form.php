<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>

<div class="snow-monkey-recent-posts-widget">
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'snow-monkey' ); ?></label><br>
		<input
			type="text"
			name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
			id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
			value="<?php echo esc_attr( $instance['title'] ); ?>"
		>
	</p>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'posts-per-page' ) ); ?>"><?php esc_html_e( 'Number of posts', 'snow-monkey' ); ?></label><br>
		<input
			type="number"
			name="<?php echo esc_attr( $this->get_field_name( 'posts-per-page' ) ); ?>"
			id="<?php echo esc_attr( $this->get_field_id( 'posts-per-page' ) ); ?>"
			value="<?php echo esc_attr( $instance['posts-per-page'] ); ?>"
			step="1"
			min="1"
		>
	</p>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php esc_html_e( 'Layout', 'snow-monkey' ); ?></label>
		<select
			name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>"
			id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"
		>
			<?php
			$layouts = [
				'rich-media' => __( 'Rich media', 'snow-monkey' ),
				'simple'     => __( 'Simple', 'snow-monkey' ),
			]
			?>
			<?php foreach ( $layouts as $value => $label ) : ?>
				<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, $instance['layout'], true ); ?>><?php echo esc_html( $label ); ?></option>
			<?php endforeach; ?>
		</select>
	</p>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'link-url' ) ); ?>"><?php esc_html_e( 'Link URL', 'snow-monkey' ); ?></label><br>
		<input
			type="text"
			name="<?php echo esc_attr( $this->get_field_name( 'link-url' ) ); ?>"
			id="<?php echo esc_attr( $this->get_field_id( 'link-url' ) ); ?>"
			value="<?php echo esc_attr( $instance['link-url'] ); ?>"
		>
	</p>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'link-text' ) ); ?>"><?php esc_html_e( 'Link text', 'snow-monkey' ); ?></label><br>
		<input
			type="text"
			name="<?php echo esc_attr( $this->get_field_name( 'link-text' ) ); ?>"
			id="<?php echo esc_attr( $this->get_field_id( 'link-text' ) ); ?>"
			value="<?php echo esc_attr( $instance['link-text'] ); ?>"
		>
	</p>
</div>
