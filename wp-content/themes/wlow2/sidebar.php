<?php
/**
 * @package wlow
 */
?>
<aside id="sidebar" class="col-md-3" role="complementary">

	<div class="content-sidebar">

		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('primary') ) : ?>

		<?php endif; ?>

	</div>

</aside>
