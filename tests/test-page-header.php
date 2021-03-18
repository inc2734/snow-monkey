<?php
class Page_Header_Test extends WP_UnitTestCase {

	public function setup() {
		parent::setup();
	}

	public function tearDown() {
		parent::tearDown();
	}

	protected function _get_page_header_class() {
		$class = new ReflectionClass( '\Framework\Helper' );
		$method = $class->getMethod( '_get_page_header_class' );
		$method->setAccessible( true );
		return $method->invokeArgs( null, [] );
	}

	/**
	 * @test
	 * @backupStaticAttributes enabled
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function is_search() {
		$this->go_to( home_url() . '?s=.' );
		$this->assertEquals( '\Framework\Model\Page_Header\Default_Page_Header', $this->_get_page_header_class() );
		$this->assertEquals( '\Framework\Model\Page_Header\Default_Page_Header', \Framework\Helper::get_page_header_class() );
	}

	/**
	 * @test
	 * @backupStaticAttributes enabled
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function is_404() {
		$this->go_to( home_url() . '?p=10000000' );
		$this->assertEquals( '\Framework\Model\Page_Header\Default_Page_Header', $this->_get_page_header_class() );
		$this->assertEquals( '\Framework\Model\Page_Header\Default_Page_Header', \Framework\Helper::get_page_header_class() );
	}

	/**
	 * @test
	 * @backupStaticAttributes enabled
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function is_single() {
		$post_id = $this->factory->post->create( [ 'post_type' => 'post' ] );
		$this->go_to( get_permalink( $post_id ) );
		$this->assertEquals( '\Framework\Model\Page_Header\Singular_Page_Header', $this->_get_page_header_class() );
		$this->assertEquals( '\Framework\Model\Page_Header\Singular_Page_Header', \Framework\Helper::get_page_header_class() );
	}

	/**
	 * @test
	 * @backupStaticAttributes enabled
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function is_page() {
		$post_id = $this->factory->post->create( [ 'post_type' => 'page' ] );
		$this->go_to( get_permalink( $post_id ) );
		$this->assertEquals( '\Framework\Model\Page_Header\Singular_Page_Header', $this->_get_page_header_class() );
		$this->assertEquals( '\Framework\Model\Page_Header\Singular_Page_Header', \Framework\Helper::get_page_header_class() );
	}

	/**
	 * @test
	 * @backupStaticAttributes enabled
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function is_front_page() {
		$post_id = $this->factory->post->create( [ 'post_type' => 'page' ] );
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $post_id );
		$this->go_to( get_permalink( $post_id ) );
		$this->assertEquals( '\Framework\Model\Page_Header\Front_Page_Header', $this->_get_page_header_class() );
		$this->assertEquals( '\Framework\Model\Page_Header\Front_Page_Header', \Framework\Helper::get_page_header_class() );
	}

	/**
	 * @test
	 * @backupStaticAttributes enabled
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function is_category() {
		$term_id = $this->factory->category->create();
		$this->go_to( get_term_link( $term_id, 'category' ) );
		$this->assertEquals( '\Framework\Model\Page_Header\Term_Page_Header', $this->_get_page_header_class() );
		$this->assertEquals( '\Framework\Model\Page_Header\Term_Page_Header', \Framework\Helper::get_page_header_class() );
	}

	/**
	 * @test
	 * @backupStaticAttributes enabled
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function is_home() {
		$this->go_to( get_home_url() );
		$this->assertEquals( '\Framework\Model\Page_Header\Archive_Page_Header', $this->_get_page_header_class() );
		$this->assertEquals( '\Framework\Model\Page_Header\Archive_Page_Header', \Framework\Helper::get_page_header_class() );
	}

	/**
	 * @test
	 * @backupStaticAttributes enabled
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function is_blog_home() {
		$front_page_id = $this->factory->post->create( [ 'post_type' => 'page' ] );
		$home_page_id  = $this->factory->post->create( [ 'post_type' => 'page' ] );
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id );
		update_option( 'page_for_posts', $home_page_id );
		$this->go_to( get_permalink( $home_page_id ) );
		$this->assertEquals( '\Framework\Model\Page_Header\Archive_Page_Header', $this->_get_page_header_class() );
		$this->assertEquals( '\Framework\Model\Page_Header\Archive_Page_Header', \Framework\Helper::get_page_header_class() );
	}

	/**
	 * @test
	 * @backupStaticAttributes enabled
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function is_date() {
		$post_id = $this->factory->post->create( [ 'post_type' => 'post' ] );
		$post    = get_post( $post_id );
		$this->go_to( home_url() . '?year=' . date( 'Y', strtotime( $post->post_date ) ) );
		$this->assertEquals( '\Framework\Model\Page_Header\Archive_Page_Header', $this->_get_page_header_class() );
		$this->assertEquals( '\Framework\Model\Page_Header\Archive_Page_Header', \Framework\Helper::get_page_header_class() );
	}

	/**
	 * @test
	 * @backupStaticAttributes enabled
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function is_tag() {
		$term_id = $this->factory->tag->create();
		$this->go_to( get_term_link( $term_id, 'post_tag' ) );
		$this->assertEquals( '\Framework\Model\Page_Header\Term_Page_Header', $this->_get_page_header_class() );
		$this->assertEquals( '\Framework\Model\Page_Header\Term_Page_Header', \Framework\Helper::get_page_header_class() );
	}

	/**
	 * @test
	 * @backupStaticAttributes enabled
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function is_post_type_archive() {
		register_post_type( 'test_post_type', [ 'public' => true, 'has_archive' => true ] );
		$post_id = $this->factory->post->create( [ 'post_type' => 'test_post_type' ] );
		$this->go_to( get_post_type_archive_link( 'test_post_type' ) );
		$this->assertEquals( '\Framework\Model\Page_Header\Archive_Page_Header', $this->_get_page_header_class() );
		$this->assertEquals( '\Framework\Model\Page_Header\Archive_Page_Header', \Framework\Helper::get_page_header_class() );
	}

	/**
	 * @test
	 * @backupStaticAttributes enabled
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function is_custom_post() {
		register_post_type( 'test_post_type', [ 'public' => true, 'has_archive' => true ] );
		$post_id = $this->factory->post->create( [ 'post_type' => 'test_post_type' ] );
		$this->go_to( get_permalink( $post_id ) );
		$this->assertEquals( '\Framework\Model\Page_Header\Singular_Page_Header', $this->_get_page_header_class() );
		$this->assertEquals( '\Framework\Model\Page_Header\Singular_Page_Header', \Framework\Helper::get_page_header_class() );
	}

	/**
	 * @test
	 * @backupStaticAttributes enabled
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function is_term() {
		register_post_type( 'test_post_type', [ 'public' => true, 'taxonomies' => [ 'test_tax' ] ] );
		register_taxonomy( 'test_tax', [ 'test_post_type' ] );
		$term_id = $this->factory->term->create( [ 'taxonomy' => 'test_tax', 'name' => 'test_term' ] );
		$this->go_to( get_term_link( $term_id, 'test_tax' ) );
		$this->assertEquals( '\Framework\Model\Page_Header\Term_Page_Header', $this->_get_page_header_class()  );
		$this->assertEquals( '\Framework\Model\Page_Header\Term_Page_Header', \Framework\Helper::get_page_header_class() );
	}
}
