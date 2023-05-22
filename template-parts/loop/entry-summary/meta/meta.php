<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.0
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
		'_terms'             => array(),
	)
);
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
				<?php
				$date_format = get_option( 'date_format' );
				the_time( $date_format );
				?>
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
