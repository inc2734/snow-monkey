<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 *
 * renamed: template-parts/loop/entry-summary/meta/meta-rss.php
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_item' => false,
	]
);

if ( ! $args['_item'] || ! is_a( $args['_item'], 'SimplePie_Item' ) ) {
	return;
}

$item = $args['_item'];
$feed = $item->get_feed();
?>

<div class="c-entry-summary__meta">
	<ul class="c-meta">
		<li class="c-meta__item c-meta__item--author">
			<?php
			$image_url = $feed->get_image_url();

			// note
			if ( ! $image_url ) {
				$item_tags_creator_image = $item->get_item_tags( 'https://note.com', 'creatorImage' );
				if ( isset( $item_tags_creator_image[0]['data'] ) ) {
					$image_url = $item_tags_creator_image[0]['data'];
				}
			}

			if ( $image_url ) {
				echo wp_kses_post(
					sprintf(
						'<img src="%1$s" alt="%2$s" width="%3$s" height="%4$s">',
						esc_url( $image_url ),
						esc_attr( $feed->get_image_title() ),
						esc_attr( $feed->get_image_width() ),
						esc_attr( $feed->get_image_height() )
					)
				);
			}

			echo esc_html( $feed->get_title() );
			?>
		</li>
		<li class="c-meta__item c-meta__item--published">

			<?php echo esc_html( date_i18n( get_option( 'date_format' ), $item->get_date( 'U' ) ) ); ?>
		</li>
	</ul>
</div>
