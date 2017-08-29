<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$theme_link = sprintf(
	'<a href="https://2inc.org" target="_blank">%s</a>',
	__( 'Monkey Wrench', 'snow-monkey' )
);

$wordpress_link = sprintf(
	'<a href="https://wordpress.org/" target="_blank">%s</a>',
	__( 'WordPress', 'snow-monkey' )
);

$theme_by   = sprintf( __( 'Snow Monkey theme by %s', 'snow-monkey' ), $theme_link );
$powered_by = sprintf( __( 'Powered by %s', 'snow-monkey' ), $wordpress_link );
$copyright  = $theme_by . ' ' . $powered_by;
?>

<div class="c-copyright">
	<div class="c-container">
		<?php echo wp_kses_post( apply_filters( 'snow_monkey_copyright', $copyright ) ); ?>
	</div>
</div>
