<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.0.0
 *
 * renamed: template-parts/header-content.php
 */

use Framework\Helper;

$content = Helper::get_var( $_content, get_theme_mod( 'header-content' ) );

if ( ! $content ) {
	return;
}
?>

<div class="c-header-content">
	<?php echo wp_kses_post( $content ); ?>
</div>
