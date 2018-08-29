<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>

<div id="sm-overlay-search-box" class="p-overlay-search-box">
	<a href="#_" class="p-overlay-search-box__bg"></a>
	<a href="#_" class="p-overlay-search-box__close-btn">
		<i class="fas fa-times" aria-label="<?php esc_html_e( 'Close', 'snow-monkey' ); ?>"></i>
	</a>

	<div class="p-overlay-search-box__inner">
		<?php
		$form = get_search_form( false );
		$form = str_replace(
			'<button class="c-input-group__btn">' . esc_html__( 'Search', 'inc2734-wp-basis' ) . '</button>',
			'<button class="c-input-group__btn"><i class="fas fa-search" aria-label="' . esc_html__( 'Search', 'inc2734-wp-basis' ) . '"></i></button>',
			$form
		);

		// @codingStandardsIgnoreStart
		echo $form;
		// @codingStandardsIgnoreEnd
		?>
	</div>
</div>
