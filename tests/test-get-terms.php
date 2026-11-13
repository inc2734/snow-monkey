<?php
class GetTermsTest extends WP_UnitTestCase {

	public function test_flat_query_includes_descendants_and_preserves_the_limit() {
		$parent = self::factory()->category->create( array( 'name' => 'Color parent' ) );
		$child = self::factory()->category->create( array( 'name' => 'Color child', 'parent' => $parent ) );
		$grandchild = self::factory()->category->create( array( 'name' => 'Color grandchild', 'parent' => $child ) );
		$args = array( 'taxonomy' => 'category', 'hide_empty' => false, 'include' => array( $parent, $child, $grandchild ), 'number' => 2 );
		$expected = wp_list_pluck( get_terms( $args ), 'term_id' );
		$actual = wp_list_pluck( Framework\Helper::get_terms( array_merge( $args, array( 'hierarchical' => false ) ) ), 'term_id' );
		$this->assertSame( $expected, $actual );
		$this->assertSame( array( $child, $grandchild ), $actual );
	}

	public function test_different_query_arguments_do_not_share_cached_results() {
		$first = self::factory()->category->create( array( 'name' => 'First color category' ) );
		$second = self::factory()->category->create( array( 'name' => 'Second color category' ) );
		$args = array( 'taxonomy' => 'category', 'hide_empty' => false, 'hierarchical' => false );
		$one = Framework\Helper::get_terms( array_merge( $args, array( 'include' => array( $first ) ) ) );
		$two = Framework\Helper::get_terms( array_merge( $args, array( 'include' => array( $second ) ) ) );
		$this->assertSame( array( $first ), wp_list_pluck( $one, 'term_id' ) );
		$this->assertSame( array( $second ), wp_list_pluck( $two, 'term_id' ) );
	}

	public function test_filtered_limit_is_part_of_the_cache_key() {
		$ids = self::factory()->category->create_many( 3 );
		$args = array( 'taxonomy' => 'category', 'hide_empty' => false, 'hierarchical' => false, 'include' => $ids );
		$limit = function () { return 1; };
		add_filter( 'snow_monkey_get_terms_max_number', $limit );
		$this->assertCount( 1, Framework\Helper::get_terms( $args ) );
		remove_filter( 'snow_monkey_get_terms_max_number', $limit );
		$this->assertCount( 3, Framework\Helper::get_terms( $args ) );
	}
}
