<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.0.0
 */

use Framework\Helper;

$wp_page_template         = get_post_meta( get_the_ID(), '_wp_page_template', true );
$use_home_page_container  = get_theme_mod( 'home-page-container' );
$is_default_page_template = 'default' === $wp_page_template;
$is_one_column_full       = false !== strpos( $wp_page_template, 'one-column-full.php' );

$require_container = ( ! $wp_page_template || $is_default_page_template || $is_one_column_full ) && $use_home_page_container;
?>

<?php do_action( 'snow_monkey_before_entry_content' ); ?>

<div
	class="c-entry__content p-entry-content"
	data-home-page-container="<?php echo esc_attr( $require_container ? 'true' : 'false' ); ?>"
>
	<?php do_action( 'snow_monkey_prepend_entry_content' ); ?>

	<?php the_content(); ?>
	<?php Helper::get_template_part( 'template-parts/content/link-pages' ); ?>

	<?php do_action( 'snow_monkey_append_entry_content' ); ?>
</div>

<?php do_action( 'snow_monkey_after_entry_content' ); ?>
