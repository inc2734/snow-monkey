<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 27.2.0
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_entries_id'        => null,
		'_display_author'    => false,
		'_display_published' => false,
		'_display_modified'  => false,
		'_display_date_icon' => false,
		'_terms'             => array(),
	)
);

$date_format = get_option( 'date_format' );
?>

<div class="c-entry-summary__meta">
	<ul class="c-meta">
		<?php if ( $args['_display_author'] ) : ?>
			<li class="c-meta__item c-meta__item--author">
				<?php
				echo get_avatar( get_the_author_meta( 'ID' ) );
				echo esc_html( get_the_author() );
				?>
			</li>
		<?php endif; ?>

		<?php if ( $args['_display_published'] ) : ?>
			<li class="c-meta__item c-meta__item--published">
				<?php if ( $args['_display_date_icon'] ) : ?>
					<i class="fa-regular fa-clock" aria-hidden="true"></i>
				<?php endif; ?>

				<span class="screen-reader-text"><?php esc_html_e( 'Published', 'snow-monkey' ); ?></span>
				<time datetime="<?php the_time( 'c' ); ?>"><?php the_time( $date_format ); ?></time>
			</li>
		<?php endif; ?>

		<?php if ( $args['_display_modified'] ) : ?>
			<li class="c-meta__item c-meta__item--modified">
				<?php if ( $args['_display_date_icon'] ) : ?>
					<i class="fa-solid fa-rotate" aria-hidden="true"></i>
				<?php endif; ?>

				<span class="screen-reader-text"><?php esc_html_e( 'Modified', 'snow-monkey' ); ?></span>
				<time datetime="<?php the_modified_time( 'c' ); ?>"><?php the_modified_time( $date_format ); ?></time>
			</li>
		<?php endif; ?>

		<?php if ( $args['_terms'] ) : ?>
			<li class="c-meta__item c-meta__item--categories">
				<?php
				Helper::get_template_part(
					'template-parts/loop/entry-summary/term/term',
					$args['_name'],
					array(
						'_context'    => $args['_context'],
						'_entries_id' => $args['_entries_id'],
						'_terms'      => $args['_terms'],
					)
				);
				?>
			</li>
		<?php endif; ?>
	</ul>
</div>
