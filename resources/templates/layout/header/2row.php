<?php
/**
 * Name: Two rows
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 8.0.0
 */

use Framework\Helper;

$header_position = Helper::get_header_position();
$default_header_position = Helper::get_default_header_position();
?>
<header class="l-header" role="banner" data-l-header-type="<?php echo esc_attr( $header_position ); ?>" data-snow-monkey-default-header-position="<?php echo esc_attr( $default_header_position ); ?>">
	<?php Helper::get_template_part( 'template-parts/header/2row' ); ?>

	<?php if ( has_nav_menu( 'global-nav' ) ) : ?>
		<div class="l-header__drop-nav" aria-hidden="true">
			<div class="c-container">
				<?php Helper::get_template_part( 'template-parts/nav/global' ); ?>
			</div>
		</div>
	<?php endif; ?>
</header>
