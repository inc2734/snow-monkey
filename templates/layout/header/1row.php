<?php
/**
 * Name: One row
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.1.0
 */

use Framework\Helper;

$classes = Helper::get_header_classes();
?>

<header class="<?php echo esc_attr( join( ' ', $classes ) ); ?>" role="banner">
	<?php
	if ( get_theme_mod( 'infobar-content' ) ) {
		Helper::get_template_part(
			'template-parts/common/infobar',
			null,
			[
				'_content' => get_theme_mod( 'infobar-content' ),
				'_url'     => get_theme_mod( 'infobar-url' ),
				'_align'   => get_theme_mod( 'infobar-align' ),
			]
		);
	}
	?>

	<div class="l-header__content">
		<?php Helper::get_template_part( 'template-parts/header/1row' ); ?>
	</div>

	<?php if ( Helper::has_drop_nav() ) : ?>
		<div class="l-header__drop-nav" aria-hidden="true">
			<?php Helper::get_template_part( 'template-parts/nav/drop' ); ?>
		</div>
	<?php endif; ?>
</header>
