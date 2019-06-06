<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.0.0
 */

use Framework\Helper;
?>

<header class="c-entry__header">
	<h1 class="c-entry__title"><?php echo wp_kses_post( Helper::get_page_title_from_breadcrumbs() ); ?></h1>
</header>
