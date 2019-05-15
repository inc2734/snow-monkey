<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
?>

<div class="c-entry__content p-entry-content">
	<p>
		<?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'snow-monkey' ); ?>
	</p>

	<?php Helper::get_template_part( 'template-parts/common/search-form', 'no-match' ); ?>
</div>
