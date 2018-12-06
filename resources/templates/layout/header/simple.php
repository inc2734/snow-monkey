<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;

$header_position = snow_monkey_get_header_position();
$default_header_position = snow_monkey_get_default_header_position();
?>
<header class="l-header" role="banner" data-l-header-type="<?php echo esc_attr( $header_position ); ?>" data-snow-monkey-default-header-position="<?php echo esc_attr( $default_header_position ); ?>">
	<?php Helper\get_template_part( 'template-parts/simple-header' ); ?>
</header>
