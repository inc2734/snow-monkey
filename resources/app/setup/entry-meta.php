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
		<time itemprop="datePublished" datetime="<?php the_time( 'c' ); ?>">
			<i class="fa fa-clock-o" aria-hidden="true"></i>
			<span class="screen-reader-text"><?php esc_html_e( 'Published', 'snow-monkey' ); ?></span>
			<?php the_time( get_option( 'date_format' ) ); ?>
		</time>
	</li>
	<?php
}
add_action( 'snow_monkey_entry_meta_items', 'snow_monkey_entry_meta_items_published', 10 );

/**
 * Modified
 */
function snow_monkey_entry_meta_items_modified() {
	if ( get_the_time( 'Ymd' ) === get_the_modified_time( 'Ymd' ) ) {
		return;
	}
	?>
	<li class="c-meta__item c-meta__item--modified">
		<time itemprop="dateModified" datetime="<?php the_modified_time( 'c' ); ?>">
			<i class="fa fa-refresh" aria-hidden="true"></i>
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
	$categories = get_the_terms( get_the_ID(), 'category' );
	if ( ! $categories ) {
		return;
	}
	?>
	<li class="c-meta__item c-meta__item--categories">
		<span class="screen-reader-text"><?php esc_html_e( 'Categories', 'snow-monkey' ); ?></span>
		<i class="fa fa-folder" aria-hidden="true"></i>
		<a href="<?php echo esc_url( get_term_link( $categories[0] ) ); ?>"><?php echo esc_html( $categories[0]->name ); ?></a>
	</li>
	<?php
}
add_action( 'snow_monkey_entry_meta_items', 'snow_monkey_entry_meta_items_categories', 40 );
