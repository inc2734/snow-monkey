<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$entry_meta = [];

/**
 * Published
 */
$entry_meta['published'] = sprintf(
	'<time datetime="%s">
		<i class="fa fa-clock-o" aria-hidden="true"></i>
		<span class="screen-reader-text">%s</span>
		%s
	</time>',
	esc_attr( get_the_time( 'c' ) ),
	esc_html__( 'Published', 'snow-monkey' ),
	esc_html( get_the_time( get_option( 'date_format' ) ) )
);

/**
 * Modified
 */
if ( get_the_time( 'Ymd' ) !== get_the_modified_time( 'Ymd' ) ) {
	$entry_meta['modified'] = sprintf(
		'<time datetime="%s">
			<i class="fa fa-refresh" aria-hidden="true"></i>
			<span class="screen-reader-text">%s</span>
			%s
		</time>',
		esc_attr( get_the_modified_time( 'c' ) ),
		esc_html__( 'Modified', 'snow-monkey' ),
		esc_html( get_the_modified_time( get_option( 'date_format' ) ) )
	);
}

/**
 * Author
 */
$entry_meta['author'] = sprintf(
	'<span class="screen-reader-text">%s</span>
	<i class="fa fa-user" aria-hidden="true"></i>
	<a href="%s">%s</a>',
	esc_html__( 'Author', 'snow-monkey' ),
	esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
	esc_html( get_the_author() )
);

/**
 * Categories
 */
$categories = get_the_terms( get_the_ID(), 'category' );
if ( $categories ) {
	$entry_meta['categories'] = sprintf(
		'<span class="screen-reader-text">%s</span>
		<i class="fa fa-folder" aria-hidden="true"></i>
		<a href="%s">%s</a>',
		esc_html__( 'Categories', 'snow-monkey' ),
		esc_url( get_term_link( $categories[0] ) ),
		esc_html( $categories[0]->name )
	);
}

/**
 * Tags
 */
$tags = get_the_tag_list( '', ', ' );
if ( $tags ) {
	$entry_meta['tags'] = sprintf(
		'<span class="screen-reader-text">%s</span>
		<i class="fa fa-tags" aria-hidden="true"></i>
		%s',
		esc_html__( 'Tags', 'snow-monkey' ),
		get_the_tag_list( '', ', ' )
	);
}

$entry_meta = apply_filters( 'snow_monkey_entry_meta_items', $entry_meta );
?>

<ul class="c-meta">
	<?php foreach ( $entry_meta as $key => $item ) : ?>
		<li class="c-meta__item c-meta__item--<?php echo esc_attr( $key ); ?>">
			<?php
			$allowed_html = wp_kses_allowed_html( 'post' );
			if ( ! isset( $allowed_html['time'] ) ) {
				$allowed_html['time'] = [
					'datetime' => [],
				];
			}
			echo wp_kses( $item, $allowed_html );
			?>
		</li>
	<?php endforeach; ?>
</ul>
