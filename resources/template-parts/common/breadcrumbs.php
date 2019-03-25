<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Breadcrumbs\Breadcrumbs;

if ( is_front_page() ) {
	return;
}

$breadcrumbs = new Breadcrumbs();
$_items = $breadcrumbs->get();
$_items = apply_filters( 'snow_monkey_breadcrumbs', $_items );

$items  = [];
$unique_checker = [];
foreach ( $_items as $key => $item ) {
	if ( ! in_array( $item['link'], $unique_checker ) ) {
		$unique_checker[] = $item['link'];
		$items[] = $item;
	}
}
?>

<ol class="c-breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
	<?php foreach ( $items as $key => $item ) : ?>
		<li class="c-breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
			<?php if ( empty( $item['link'] ) ) : ?>
				<span itemscope itemtype="http://schema.org/Thing" itemprop="item" itemid="<?php echo esc_url( $item['link'] ); ?>">
					<span itemprop="name"><?php echo esc_html( strip_tags( $item['title'] ) ); ?></span>
				</span>
			<?php else : ?>
				<a itemscope itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo esc_url( $item['link'] ); ?>" itemid="<?php echo esc_url( $item['link'] ); ?>">
					<span itemprop="name"><?php echo esc_html( strip_tags( $item['title'] ) ); ?></span>
				</a>
			<?php endif; ?>
			<meta itemprop="position" content="<?php echo esc_attr( $key + 1 ); ?>" />
		</li>
	<?php endforeach; ?>
</ol>
