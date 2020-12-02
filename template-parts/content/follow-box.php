<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 12.0.0
 */

use Framework\Helper;

if ( ! has_nav_menu( 'follow-box' ) ) {
	return;
}

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_title' => __( 'Follow us on SNS', 'snow-monkey' ),
		'_lead'  => __( 'We will deliver up-to-date information for you', 'snow-monkey' ),
	]
);
?>

<div class="p-follow-box">
	<div class="p-follow-box__figure">
		<?php echo get_the_post_thumbnail( get_the_ID(), 'large' ); ?>
	</div>

	<div class="p-follow-box__inner">
		<h3 class="p-follow-box__title"><?php echo esc_html( $args['_title'] ); ?></h3>
		<div class="p-follow-box__lead">
			<?php echo esc_html( $args['_lead'] ); ?>
		</div>

		<div class="p-follow-box__nav">
			<?php Helper::get_template_part( 'template-parts/nav/follow-box' ); ?>
		</div>
	</div>
</div>
