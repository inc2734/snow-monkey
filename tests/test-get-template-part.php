<?php
class GetTemplatePartTest extends WP_UnitTestCase {

	public function set_up() {
		parent::set_up();
	}

	public function tear_down() {
		parent::tear_down();
	}

	/**
	 * @test
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function args_slug() {
		add_filter(
			'snow_monkey_get_template_part_args_template',
			function( $args ) {
				$args['slug'] = 'template2';
				$args['name'] = 'name2';
				$args['vars'] = [ 'key' => 'value2' ];
				return $args;
			}
		);

		add_action(
			'inc2734_wp_view_controller_get_template_part_pre_render',
			function( $args ) {
				$this->assertEquals( 'template2', $args['slug'] );
				$this->assertEquals( 'name2', $args['name'] );
				$this->assertEquals( 'value2', $args['vars']['key'] );
			}
		);

		add_action( 'snow_monkey_get_template_part_template2-name2', '__return_true' );
		Framework\Helper::get_template_part( 'template', 'name', [ 'key' => 'value' ] );
	}

	/**
	 * @test
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function args() {
		add_filter(
			'snow_monkey_get_template_part_args',
			function( $args ) {
				$args['slug'] = 'template2';
				$args['name'] = 'name2';
				$args['vars'] = [ 'key' => 'value2' ];
				return $args;
			}
		);

		add_action(
			'inc2734_wp_view_controller_get_template_part_pre_render',
			function( $args ) {
				$this->assertEquals( 'template2', $args['slug'] );
				$this->assertEquals( 'name2', $args['name'] );
				$this->assertEquals( 'value2', $args['vars']['key'] );
			}
		);

		add_action( 'snow_monkey_get_template_part_template2-name2', '__return_true' );
		Framework\Helper::get_template_part( 'template', 'name', [ 'key' => 'value' ] );
	}

	/**
	 * @test
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function context() {
		add_filter(
			'snow_monkey_get_template_part_args',
			function( $args ) {
				$args['vars']['_context'] = 'fuga';
				return $args;
			}
		);

		add_action(
			'inc2734_wp_view_controller_get_template_part_pre_render',
			function( $args ) {
				if ( 'template' === $args['slug'] ) {
					$this->assertSame( null, $args['vars']['_context'] );
				}

				if ( 'template2' === $args['slug'] ) {
					$this->assertEquals( 'foo', $args['vars']['_context'] );
				}
			}
		);

		add_action( 'snow_monkey_get_template_part_template-name', '__return_true' );
		Framework\Helper::get_template_part( 'template', 'name' );

		add_action( 'snow_monkey_get_template_part_template2', '__return_true' );
		Framework\Helper::get_template_part( 'template2', null, [ '_context' => 'foo' ] );
	}

	/**
	 * @test
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function name() {
		add_filter(
			'snow_monkey_get_template_part_args',
			function( $args ) {
				$args['vars']['_name'] = 'fuga';
				return $args;
			}
		);

		add_action(
			'inc2734_wp_view_controller_get_template_part_pre_render',
			function( $args ) {
				if ( 'template' === $args['slug'] ) {
					$this->assertEquals( 'name', $args['vars']['_name'] );
				}

				if ( 'template2' === $args['slug'] ) {
					$this->assertEquals( null, $args['vars']['_name'] );
				}
			}
		);

		add_action( 'snow_monkey_get_template_part_template-name', '__return_true' );
		Framework\Helper::get_template_part( 'template', 'name' );

		add_action( 'snow_monkey_get_template_part_template2', '__return_true' );
		Framework\Helper::get_template_part( 'template2', null );
	}

	/**
	 * @test
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 * @group hoge
	 */
	public function template_part_root_hierarchy_slug() {
		$root = untrailingslashit( sys_get_temp_dir() ) . '/template-parts';
		$file = $root . '/template-name.php';
		file_exists( $file ) && unlink( $file );
		is_dir( $root ) && rmdir( $root );
		mkdir( $root );
		file_put_contents( $file, 'hierarchy-test' );

		$root2 = untrailingslashit( sys_get_temp_dir() ) . '/template-parts2';
		$file2 = $root2 . '/template-name.php';
		file_exists( $file2 ) && unlink( $file2 );
		is_dir( $root2 ) && rmdir( $root2 );
		mkdir( $root2 );
		file_put_contents( $file2, 'hierarchy-test2' );

		add_filter(
			'snow_monkey_template_part_root_hierarchy_template',
			function( $hierarchy ) use ( $root, $root2 ) {
				$hierarchy[] = $root;
				$hierarchy[] = $root2;
				return $hierarchy;
			}
		);

		ob_start();
		Framework\Helper::get_template_part( 'template', 'name' );
		$this->assertEquals( 'hierarchy-test', ob_get_clean() );

		file_exists( $file ) && unlink( $file );
		ob_start();
		Framework\Helper::get_template_part( 'template', 'name' );
		$this->assertEquals( 'hierarchy-test2', ob_get_clean() );

		file_exists( $file2 ) && unlink( $file2 );
		ob_start();
		add_action( 'snow_monkey_get_template_part_template-name', '__return_true' );
		Framework\Helper::get_template_part( 'template', 'name' );
		$this->assertEquals( '', ob_get_clean() );
	}

	/**
	 * @test
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function template_part_root_hierarchy() {
		$root = untrailingslashit( sys_get_temp_dir() ) . '/template-parts';
		$file = $root . '/template-name.php';
		file_exists( $file ) && unlink( $file );
		is_dir( $root ) && rmdir( $root );
		mkdir( $root );
		file_put_contents( $file, 'hierarchy-test' );

		$root2 = untrailingslashit( sys_get_temp_dir() ) . '/template-parts2';
		$file2 = $root2 . '/template-name.php';
		file_exists( $file2 ) && unlink( $file2 );
		is_dir( $root2 ) && rmdir( $root2 );
		mkdir( $root2 );
		file_put_contents( $file2, 'hierarchy-test2' );

		add_filter(
			'snow_monkey_template_part_root_hierarchy',
			function( $hierarchy ) use ( $root, $root2 ) {
				$hierarchy[] = $root;
				$hierarchy[] = $root2;
				return $hierarchy;
			}
		);

		ob_start();
		Framework\Helper::get_template_part( 'template', 'name' );
		$this->assertEquals( 'hierarchy-test', ob_get_clean() );

		file_exists( $file ) && unlink( $file );
		ob_start();
		Framework\Helper::get_template_part( 'template', 'name' );
		$this->assertEquals( 'hierarchy-test2', ob_get_clean() );

		file_exists( $file2 ) && unlink( $file2 );
		ob_start();
		add_action( 'snow_monkey_get_template_part_template-name', '__return_true' );
		Framework\Helper::get_template_part( 'template', 'name' );
		$this->assertEquals( '', ob_get_clean() );
	}

	/**
	 * @test
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function defined_html() {
		add_action(
			'snow_monkey_get_template_part_template-name',
			function() {
				echo 'template-name';
			}
		);

		add_action(
			'snow_monkey_get_template_part_template-name',
			function() {
				echo '2-template-name';
			}
		);

		add_action(
			'snow_monkey_get_template_part_template',
			function() {
				echo 'template';
			}
		);

		ob_start();
		Framework\Helper::get_template_part( 'template', 'name' );
		$this->assertEquals( 'template-name2-template-name', ob_get_clean() );

		add_filter(
			'snow_monkey_template_part_render_template',
			function( $html, $name ) {
				if ( 'name' === $name ) {
					return '3-template-name';
				}
			},
			10,
			2
		);

		ob_start();
		Inc2734\WP_View_Controller\Helper::get_template_part( 'template', 'name' );
		$this->assertEquals( '3-template-name', ob_get_clean() );

		add_filter(
			'snow_monkey_template_part_render',
			function( $html, $slug, $name ) {
				if ( 'template' === $slug && 'name' === $name ) {
					return '4-template-name';
				}
			},
			10,
			3
		);

		ob_start();
		Framework\Helper::get_template_part( 'template', 'name' );
		$this->assertEquals( '4-template-name', ob_get_clean() );
	}
}
