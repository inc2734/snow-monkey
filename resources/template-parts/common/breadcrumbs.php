<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 7.0.0
 *
 * renamed: template-parts/breadcrumbs.php
 */

use Framework\Helper;

$template_args = [
	'items' => Helper::get_var( $_items, Helper::get_breadcrumbs_items() ),
];

$template_args['items'] = array_values( $template_args['items'] );

if ( ! $template_args['items'] ) {
	return;
}
?>

<ol class="c-breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
	<?php foreach ( $template_args['items'] as $key => $item ) : ?>
		<li class="c-breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
			<a itemscope itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo esc_url( $item['link'] ); ?>" itemid="<?php echo esc_url( $item['link'] ); ?>">
				<span itemprop="name"><?php echo esc_html( strip_tags( $item['title'] ) ); ?></span>
			</a>
			<meta itemprop="position" content="<?php echo esc_attr( $key + 1 ); ?>" />
		</li>
	<?php endforeach; ?>
</ol>
