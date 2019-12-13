<?php
/**
 * Name: Simple
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version <version>
 */

use Framework\Helper;

$classes = Helper::get_header_classes();
?>
<header class="<?php echo esc_attr( join( ' ', $classes ) ); ?>" role="banner">
	<?php Helper::get_template_part( 'template-parts/header/simple' ); ?>
</header>
