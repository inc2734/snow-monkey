<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Published
 */
function snow_monkey_entry_meta_items_published() {
	?>
	<li class="c-meta__item c-meta__item--published">
		<time datetime="<?php the_time( 'c' ); ?>">
			<i class="far fa-clock" aria-hidden="true"></i>
			<span class="screen-reader-text"><?php esc_html_e( 'Published', 'snow-monkey' ); ?></span>
			<?php the_time( get_option( 'date_format' ) ); ?>
		</time>
	</li>
	<?php
}
add_action( 'snow_monkey_entry_meta_items', 'snow_monkey_entry_meta_items_published', 10 );

/**
 * Published - No time tag
 */
function snow_monkey_entry_meta_items_published_no_time() {
	?>
	<li class="c-meta__item c-meta__item--published">
		<i class="far fa-clock" aria-hidden="true"></i>
		<span class="screen-reader-text"><?php esc_html_e( 'Published', 'snow-monkey' ); ?></span>
		<?php the_time( get_option( 'date_format' ) ); ?>
	</li>
	<?php
}

/**
 * Modified
 */
function snow_monkey_entry_meta_items_modified() {
	if ( get_the_time( 'Ymd' ) === get_the_modified_time( 'Ymd' ) ) {
		return;
	}
	?>
	<li class="c-meta__item c-meta__item--modified">
		<time datetime="<?php the_modified_time( 'c' ); ?>">
			<i class="fas fa-sync-alt" aria-hidden="true"></i>
			<span class="screen-reader-text"><?php esc_html_e( 'Modified', 'snow-monkey' ); ?></span>
			<?php the_modified_time( get_option( 'date_format' ) ); ?>
		</time>
	</li>
	<?php
}
add_action( 'snow_monkey_entry_meta_items', 'snow_monkey_entry_meta_items_modified', 20 );

/**
 * Author
 */
function snow_monkey_entry_meta_items_author() {
	?>
	<li class="c-meta__item c-meta__item--author">
		<span class="screen-reader-text"><?php esc_html_e( 'Author', 'snow-monkey' ); ?></span>
		<?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?>
		<?php the_author(); ?>
	</li>
	<?php
}
add_action( 'snow_monkey_entry_meta_items', 'snow_monkey_entry_meta_items_author', 30 );

/**
 * Categories
 */
function snow_monkey_entry_meta_items_categories() {
	$taxonomies = get_object_taxonomies( get_post_type(), 'object' );
	foreach ( $taxonomies as $taxonomy ) {
		if ( ! $taxonomy->public ) {
			continue;
		}

		$terms = get_the_terms( get_the_ID(), $taxonomy->name );
		break;
	}

	if ( empty( $terms ) || is_wp_error( is_wp_error( $terms ) ) || ! is_array( $terms ) ) {
		return;
	}
	?>
	<?php foreach ( $terms as $term ) : ?>
		<li class="c-meta__item c-meta__item--categories">
			<span class="screen-reader-text"><?php echo esc_html( $taxonomy->label ); ?></span>
			<i class="fas fa-folder" aria-hidden="true"></i>
			<a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
		</li>
	<?php endforeach; ?>
	<?php
}
add_action( 'snow_monkey_entry_meta_items', 'snow_monkey_entry_meta_items_categories', 40 );
