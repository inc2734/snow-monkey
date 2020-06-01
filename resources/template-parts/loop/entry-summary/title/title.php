<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.7.0
 */

use Framework\Helper;

$template_args = [
	'title_tag' => Helper::get_var( $_title_tag, 'h2' ),
];

$layout    = get_theme_mod( get_post_type() . '-entries-layout' );
$title_tag = $template_args['title_tag'];
?>

<<?php echo esc_html( $title_tag ); ?> class="c-entry-summary__title">
	<?php
	if ( 'rich-media' !== $layout ) {
		the_title();
	} else {
		Helper::the_title_trimed();
	}
	?>
</<?php echo esc_html( $title_tag ); ?>>
