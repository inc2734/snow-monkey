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
		$method = $class->getMethod( '_get_class' );
		$method->setAccessible( true );
		return $method->invokeArgs( null, [] );
	}

	/**
	 * @test
	 */
	public function is_search() {
		$this->go_to( home_url() . '?s=.' );
		$this->assertEquals( '\Framework\Model\Page_Header\Default_Page_Header', $this->_get_page_header_class() );
	}

	/**
	 * @test
	 */
	public function is_404() {
		$this->go_to( home_url() . '?p=10000000' );
		$this->assertEquals( '\Framework\Model\Page_Header\Default_Page_Header', $this->_get_page_header_class() );
	}

	/**
	 * @test
	 */
	public function is_single() {
		$post_id = $this->factory->post->create( [ 'post_type' => 'post' ] );
		$this->go_to( get_permalink( $post_id ) );
		$this->assertEquals( '\Framework\Model\Page_Header\Singular_Page_Header', $this->_get_page_header_class() );
	}

	/**
	 * @test
	 */
	public function is_page() {
		$post_id = $this->factory->post->create( [ 'post_type' => 'page' ] );
		$this->go_to( get_permalink( $post_id ) );
		$this->assertEquals( '\Framework\Model\Page_Header\Singular_Page_Header', $this->_get_page_header_class() );
	}

	/**
	 * @test
	 */
	public function is_front_page() {
		$post_id = $this->factory->post->create( [ 'post_type' => 'page' ] );
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $post_id );
		$this->go_to( get_permalink( $post_id ) );
		$this->assertFalse( $this->_get_page_header_class() );
	}

	/**
	 * @test
	 */
	public function is_category() {
		$term_id = $this->factory->category->create();
		$this->go_to( get_term_link( $term_id, 'category' ) );
		$this->assertEquals( '\Framework\Model\Page_Header\Category_Page_Header', $this->_get_page_header_class() );
	}

	/**
	 * @test
	 */
	public function is_home() {
		$this->go_to( get_home_url() );
		$this->assertEquals( '\Framework\Model\Page_Header\Home_Page_Header', $this->_get_page_header_class() );
	}

	/**
	 * @test
	 */
	public function is_blog_home() {
		$front_page_id = $this->factory->post->create( [ 'post_type' => 'page' ] );
		$home_page_id  = $this->factory->post->create( [ 'post_type' => 'page' ] );
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id );
		update_option( 'page_for_posts', $home_page_id );
		$this->go_to( get_permalink( $home_page_id ) );
		$this->assertEquals( '\Framework\Model\Page_Header\Home_Page_Header', $this->_get_page_header_class() );
	}

	/**
	 * @test
	 */
	public function is_date() {
		$post_id = $this->factory->post->create( [ 'post_type' => 'post' ] );
		$post    = get_post( $post_id );
		$this->go_to( home_url() . '?year=' . date( 'Y', strtotime( $post->post_date ) ) );
		$this->assertEquals( '\Framework\Model\Page_Header\Home_Page_Header', $this->_get_page_header_class() );
	}

	/**
	 * @test
	 */
	public function is_tag() {
		$term_id = $this->factory->tag->create();
		$this->go_to( get_term_link( $term_id, 'post_tag' ) );
		$this->assertEquals( '\Framework\Model\Page_Header\Home_Page_Header', $this->_get_page_header_class() );
	}
}
