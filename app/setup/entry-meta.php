<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.0.5
 */

use Framework\Helper;

/**
 * Published
 */
function snow_monkey_entry_meta_items_published() {
	?>
	<li class="c-meta__item c-meta__item--published">
		<i class="far fa-clock" aria-hidden="true"></i>
		<span class="screen-reader-text"><?php esc_html_e( 'Published', 'snow-monkey' ); ?></span>
		<time datetime="<?php the_time( 'c' ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
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
	if ( get_the_time( 'Ymd' ) >= get_the_modified_time( 'Ymd' ) ) {
		return;
	}
	?>
	<li class="c-meta__item c-meta__item--modified">
		<i class="fas fa-sync-alt" aria-hidden="true"></i>
		<span class="screen-reader-text"><?php esc_html_e( 'Modified', 'snow-monkey' ); ?></span>
		<time datetime="<?php the_modified_time( 'c' ); ?>"><?php the_modified_time( get_option( 'date_format' ) ); ?></time>
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
	$public_taxonomies = Helper::get_the_public_taxonomy( get_the_ID() );
	$public_terms      = [];

	foreach ( $public_taxonomies as $public_taxonomy ) {
		$_terms = get_the_terms( get_the_ID(), $public_taxonomy->name );
		if ( $public_taxonomy->hierarchical && $_terms && is_array( $_terms ) ) {
			$public_terms = $_terms;
			break;
		}
	}

	if ( ! $public_terms ) {
		return;
	}
	?>
	<?php foreach ( $public_terms as $public_term ) : ?>
		<li class="c-meta__item c-meta__item--categories">
			<span class="screen-reader-text"><?php echo esc_html( $public_taxonomy->label ); ?></span>
			<i class="fas fa-folder" aria-hidden="true"></i>
			<a href="<?php echo esc_url( get_term_link( $public_term ) ); ?>"><?php echo esc_html( $public_term->name ); ?></a>
		</li>
	<?php endforeach; ?>
	<?php
}
add_action( 'snow_monkey_entry_meta_items', 'snow_monkey_entry_meta_items_categories', 40 );
