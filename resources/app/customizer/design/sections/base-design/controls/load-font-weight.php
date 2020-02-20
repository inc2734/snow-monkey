<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 5.0.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'multiple-checkbox',
	'load-font-weight',
	[
		'label'    => __( 'Load font weight', 'snow-monkey' ),
		'default'  => '400',
		'priority' => 121,
		'choices'  => [
			'100'  => __( 'Thin 100', 'snow-monkey' ),
			'200'  => __( 'Extra-Light 200', 'snow-monkey' ),
			'300'  => __( 'Light 300', 'snow-monkey' ),
			'400'  => __( 'Regular 400', 'snow-monkey' ),
			'500'  => __( 'Medium 500', 'snow-monkey' ),
			'600'  => __( 'Semi-Bold 600', 'snow-monkey' ),
			'700'  => __( 'Bold 700', 'snow-monkey' ),
			'800'  => __( 'Extra-Bold 800', 'snow-monkey' ),
			'900'  => __( 'Black 900', 'snow-monkey' ),
		],
		'active_callback' => function() {
			return ('sans-serif') !== get_theme_mod( 'base-font' ) && ('serif') !== get_theme_mod( 'base-font' );
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'load-font-weight' );
$control->join( $section )->join( $panel );

add_action('admin_print_footer_scripts', function() {
  echo <<<EOS
<script>
jQuery(function($) {

function fontSelect() {

	const val = $('select#_customize-input-base-font').val();
	const fontWeights = {
		'noto-sans-jp' : [100,300,400,500,700,900],
		'noto-serif-jp' : [200,300,400,500,600,700,900],
		'm-plus-1p' : [100,300,400,500,700,800,900],
		'm-plus-rounded-1c' : [100,300,400,500,700,800,900],
	};

	$('#customize-control-load-font-weight ul li').hide();

	$.each(fontWeights[val], function(index,num) {
		var n = num / 100 - 1;
		$('#customize-control-load-font-weight ul li').eq(n).show();
	});

	if(event.type === 'change') {
		$('#customize-control-load-font-weight input[type="checkbox"]').prop('checked', false);
		$('#customize-control-load-font-weight input[value="400"]').prop('checked', true);
		$('#customize-control-load-font-weight input[value="700"]').prop('checked', true);
		$('#customize-control-load-font-weight input[type="hidden"]').val('400,700').trigger( 'change' );
	}
	
}
$(window).on('load',fontSelect);
$('select#_customize-input-base-font').on('change',fontSelect);

});
</script>
EOS;
});
