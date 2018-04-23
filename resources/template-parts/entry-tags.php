<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$tags = get_the_terms( get_the_ID(), 'post_tag' );
if ( ! $tags ) {
	return;
}
?>

<div class="c-entry-tags">
	<?php foreach ( $tags as $tag ) : ?>
		<a class="tag-cloud-link" href="<?php echo esc_url( get_term_link( $tag ) ); ?>"><?php echo esc_html( $tag->name ); ?></a>
	<?php endforeach; ?>
</div>
