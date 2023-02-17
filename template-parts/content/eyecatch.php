<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.1.5
 *
 * renamed: template-parts/eyecatch.php
 */

if ( ! has_post_thumbnail() ) {
	return;
}
?>

<div class="c-eyecatch">
	<?php the_post_thumbnail( 'xlarge' ); ?>
</div>
