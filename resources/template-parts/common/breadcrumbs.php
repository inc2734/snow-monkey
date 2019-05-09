<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

$items = Helper::get_var( $_items, Helper::get_breadcrumbs_items() );
$items = apply_filters( 'snow_monkey_breadcrumbs', $items );
$items = array_values( $items );

if ( ! $items ) {
	return;
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
