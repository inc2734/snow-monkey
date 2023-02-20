<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.1.6
 */

use Framework\Helper;

$use_home_page_container = get_theme_mod( 'home-page-container' );
$is_one_column_full      = 'one-column-full' === \Inc2734\WP_View_Controller\Bootstrap::get_layout();
$require_container       = $use_home_page_container && $is_one_column_full;
?>

<?php do_action( 'snow_monkey_before_entry_content' ); ?>

<div
	class="c-entry__content p-entry-content
	<?php echo $require_container ? esc_attr( 'c-container' ) : ''; ?>
	data-home-page-container="<?php echo esc_attr( $require_container ? 'true' : 'false' ); ?>"
>
	<?php do_action( 'snow_monkey_prepend_entry_content' ); ?>

	<?php the_content(); ?>
	<?php Helper::get_template_part( 'template-parts/content/link-pages' ); ?>

	<?php do_action( 'snow_monkey_append_entry_content' ); ?>
</div>

<?php do_action( 'snow_monkey_after_entry_content' ); ?>
