<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 12.2.3
 */
?>

<div class="c-entry-summary__meta">
	<ul class="c-meta">
		<li class="c-meta__item c-meta__item--author">
			<?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?><?php echo esc_html( get_the_author() ); ?>
		</li>
		<li class="c-meta__item c-meta__item--published">
			<?php the_time( get_option( 'date_format' ) ); ?>
		</li>
	</ul>
</div>
