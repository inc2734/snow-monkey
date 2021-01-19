<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_terms' => [],
	]
);
?>

<div class="c-entry-summary__meta">
	<ul class="c-meta">
		<li class="c-meta__item c-meta__item--author">
			<?php
			echo get_avatar( get_the_author_meta( 'ID' ) );
			echo esc_html( get_the_author() );
			?>
		</li>

		<li class="c-meta__item c-meta__item--published">
			<?php
			$date_format = get_option( 'date_format' );
			the_time( $date_format );
			?>
		</li>

		<?php if ( $args['_terms'] ) : ?>
			<li class="c-meta__item c-meta__item--categories">
				<?php
				Helper::get_template_part(
					'template-parts/loop/entry-summary/term/term',
					$args['_name'],
					[
						'_context' => $args['_context'],
						'_terms'   => $args['_terms'],
					]
				);
				?>
			</li>
		<?php endif; ?>
	</ul>
</div>
