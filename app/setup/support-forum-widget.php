<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.5.0
 *
 * renamed: app/setup/suppot-forum-widget.php
 */
add_action(
	'wp_dashboard_setup',
	function() {
		wp_add_dashboard_widget(
			'snow-monkey-support-forum-topics-widget',
			__( 'Recent topics of Snow Monkey support forum', 'snow-monkey' ),
			function() {
				global $wp_version;

				$transient = get_transient( 'snow-monkey-support-forum-topics' );

				if ( ! $transient ) {
					$wp_api_posts = wp_remote_get(
						'https://snow-monkey.2inc.org/wp-json/wp/v2/topic?per_page=5',
						[
							'user-agent' => 'WordPress/' . $wp_version,
						]
					);

					if ( is_wp_error( $wp_api_posts ) || 200 !== $wp_api_posts['response']['code'] ) {
						$wp_api_posts = [];
					} else {
						$wp_api_posts = json_decode( $wp_api_posts['body'] );
					}

					set_transient( 'snow-monkey-support-forum-topics', $wp_api_posts, 60 * 60 );
				} else {
					$wp_api_posts = $transient;
				}

				if ( ! $wp_api_posts ) {
					return;
				}
				?>
				<div class="wordpress-news hide-if-no-js">
					<div class="rss-widget">
						<ul id="snow-monkey-support-forum-topics">
							<?php foreach ( $wp_api_posts as $item ) : ?>
								<li><a href="<?php echo esc_url( $item->link ); ?>" target="_blank" rel="noreferrer"><?php echo esc_html( $item->title->rendered ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				<?php
			}
		);
	}
);
