<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Awesome_Components\Awesome_Components;

/**
 * Activate WP Awesome components
 */
if ( apply_filters( 'snow_monkey_use_awesome_components', false ) ) {
	new Awesome_Components();
}

/**
 * Awesome_Components の各コンポーネントをカスタマイズ
 *
 * @param array $components
 * @return array
 */
add_filter(
	'inc2734_wp_awesome_components_register_components',
	function( $components ) {
		foreach ( $components as $key => $component ) {
			if ( 'btn' === $key || 'btn--full' === $key ) {
				$component = str_replace( 'wpac-btn', 'wpac-btn c-btn', $component );
				$components[ $key ] = $component;
			} elseif ( 0 === strpos( $key, 'columns-' ) ) {
				$component = str_replace( 'wpac-columns__col-inner', 'wpac-columns__col-inner p-entry-content', $component );
				$components[ $key ] = $component;
			} elseif ( 'section' === $key || 'section--inverse' === $key ) {
				$component = str_replace( 'wpac-section ', 'c-section wpac-section ', $component );
				$component = str_replace( 'wpac-section__body', 'wpac-section__body p-entry-content', $component );
				$component = str_replace( 'wpac-section__body', 'wpac-section__body p-entry-content', $component );
				$component = str_replace( 'wpac-section__container', 'c-container', $component );
				$components[ $key ] = $component;
			}
		}
		return $components;
	},
	11
);
