<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 12.0.0
 */

use Inc2734\WP_Basis\App\Model\Navbar;
use Inc2734\WP_Basis\App\Model\Drawer;
use Framework\Helper;

/**
 * Registers wp_nav_menu() menus
 *
 * @return void
 * @see http://codex.wordpress.org/Function_Reference/register_nav_menus
 */
add_action(
	'after_setup_theme',
	function() {
		register_nav_menus(
			[
				'global-nav'        => esc_html__( 'Global Navigation (For PC)', 'snow-monkey' ),
				'drawer-nav'        => esc_html__( 'Drawer Navigation (For Mobile)', 'snow-monkey' ),
				'social-nav'        => esc_html__( 'Social Navigation', 'snow-monkey' ),
				'follow-box'        => esc_html__( 'Follow box', 'snow-monkey' ),
				'header-sub-nav'    => esc_html__( 'Header Sub Navigation', 'snow-monkey' ),
				'footer-sub-nav'    => esc_html__( 'Footer Sub Navigation', 'snow-monkey' ),
				'drawer-sub-nav'    => esc_html__( 'Drawer Sub Navigation (For Mobile)', 'snow-monkey' ),
				'footer-sticky-nav' => esc_html__( 'Footer Sticky Navigation (For Mobile)', 'snow-monkey' ),
			]
		);
	}
);

/**
 * Enqueue scripts
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_register_script(
			Helper::get_main_script_handle() . '-footer-sticky-nav',
			get_theme_file_uri( '/assets/js/footer-sticky-nav.js' ),
			[],
			filemtime( get_theme_file_path( '/assets/js/footer-sticky-nav.js' ) ),
			true
		);

		wp_register_script(
			Helper::get_main_script_handle() . '-global-nav',
			get_theme_file_uri( '/assets/js/global-nav.js' ),
			Helper::generate_script_dependencies(
				[
					Helper::get_main_script_handle() . '-drop-nav',
				]
			),
			filemtime( get_theme_file_path( '/assets/js/global-nav.js' ) ),
			true
		);

		if ( has_nav_menu( 'footer-sticky-nav' ) ) {
			wp_enqueue_script( Helper::get_main_script_handle() . '-footer-sticky-nav' );
		}

		if ( has_nav_menu( 'global-nav' ) ) {
			wp_enqueue_script( Helper::get_main_script_handle() . '-global-nav' );
		}
	},
	11
);

/**
 * Display description of nav item under it.
 *
 * @param string $title HTML
 * @param object $item
 * @param object $args
 * @param int $depth
 * @return string
 */
add_filter(
	'nav_menu_item_title',
	function( $title, $item, $args, $depth ) {
		$show_description = 0 === (int) $depth && 'global-nav' === $args->theme_location;
		$show_description = apply_filters( 'snow_monkey_nav_menu_item_title_show_description', $show_description, $depth, $args->theme_location );

		if ( ! $show_description ) {
			return $title;
		}

		$title = sprintf( '<span>%1$s</span>', $title );

		if ( $item->description ) {
			$title = $title . sprintf( '<small>%1$s</small>', esc_html( $item->description ) );
		}

		return $title;
	},
	10,
	4
);

/**
 * Add highlight nsetting to nav menu items.
 */
add_action(
	'after_setup_theme',
	function() {
		add_action(
			'wp_nav_menu_item_custom_fields',
			function( $item_id ) {
				$highlight = get_post_meta( $item_id, 'sm-nav-menu-item-highlight', true );
				?>
				<p class="field-sm-nav-menu-item-highlight description-wide">
					<label>
						<input
							type="checkbox"
							name="sm-nav-menu-item-highlight[<?php echo esc_attr( $item_id ); ?>]"
							value="1"
							<?php checked( 1, $highlight ); ?>
						/>
						<?php esc_html_e( 'Highlight this menu item.', 'snow-monkey' ); ?>
					</label>
					<?php wp_nonce_field( 'sm-nav-menu-item-highlight', 'sm-nav-menu-item-highlight-nonce' ); ?>
				</p>
				<?php
			},
			10
		);

		add_action(
			'wp_update_nav_menu_item',
			function( $menu_id, $menu_item_db_id ) {
				$nonce = filter_input( INPUT_POST, 'sm-nav-menu-item-highlight-nonce' );
				if ( ! $nonce ) {
					return;
				}

				$verify_nonce = wp_verify_nonce( $nonce, 'sm-nav-menu-item-highlight' );
				if ( ! $verify_nonce ) {
					return;
				}

				$highlight = filter_input(
					INPUT_POST,
					'sm-nav-menu-item-highlight',
					FILTER_DEFAULT,
					[
						'flags' => FILTER_REQUIRE_ARRAY,
					]
				);

				if ( $highlight && isset( $highlight[ $menu_item_db_id ] ) ) {
					update_post_meta( $menu_item_db_id, 'sm-nav-menu-item-highlight', $highlight[ $menu_item_db_id ] );
				} else {
					delete_post_meta( $menu_item_db_id, 'sm-nav-menu-item-highlight' );
				}
			},
			10,
			2
		);

		add_filter(
			'wp_nav_menu_objects',
			function( $sorted_menu_items ) {
				foreach ( $sorted_menu_items as $index => $item ) {
					$highlight = get_post_meta( $item->ID, 'sm-nav-menu-item-highlight', true );
					if ( ! $highlight ) {
						continue;
					}

					$item->classes[]             = 'sm-nav-menu-item-highlight';
					$item->classes               = array_unique( $item->classes );
					$sorted_menu_items[ $index ] = $item;
				}
				return $sorted_menu_items;
			},
			10
		);
	}
);

