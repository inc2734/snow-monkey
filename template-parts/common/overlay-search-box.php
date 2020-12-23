<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 12.1.1
 *
 * renamed: template-parts/overlay-search-box.php
 */

use Framework\Helper;
?>

<div id="sm-overlay-search-box" class="p-overlay-search-box c-overlay-container">
	<div class="p-overlay-search-box__inner c-overlay-container__inner">
		<?php
		ob_start();
		Helper::get_template_part( 'template-parts/common/search-form', 'overlay-search-box' );
		$form = ob_get_clean();

		$form = str_replace(
			'<button class="c-input-group__btn">' . esc_html_x( 'Search', 'search-form', 'snow-monkey' ) . '</button>',
			'<button class="c-input-group__btn"><i class="fas fa-search" aria-label="' . esc_html_x( 'Search', 'search-form', 'snow-monkey' ) . '"></i></button>',
			$form
		);

		$form = str_replace(
			'method="get"',
			'method="get" autocomplete="off"',
			$form
		);

		// @codingStandardsIgnoreStart
		echo $form;
		// @codingStandardsIgnoreEnd
		?>
	</div>

	<a href="#_" class="p-overlay-search-box__close-btn c-overlay-container__close-btn">
		<i class="fas fa-times" aria-label="<?php esc_html_e( 'Close', 'snow-monkey' ); ?>"></i>
	</a>
	<a href="#_" class="p-overlay-search-box__bg c-overlay-container__bg"></a>
</div>
