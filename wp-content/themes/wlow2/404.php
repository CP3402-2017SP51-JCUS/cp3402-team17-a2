<?php
/**
 * @package wlow
 */

 get_header(); ?>

	<main id="main" class="col-md-9" role="main">

		<article>

			<div class="content-article">

				<h1 class="huge margin-bottom"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'wlow' ); ?></h1>
				<h2 class="large margin-bottom"><?php esc_html_e( '404 Error', 'wlow' ); ?></h2>

				<p><?php esc_html_e( 'The page you are trying to reach does not exist, or has been moved. Please use the menus or the search box to find what you are looking for.', 'wlow' ); ?></p>

				<?php get_search_form(); ?>

			</div>

		</article>

	</main>

	<?php get_sidebar(); ?>


<?php get_footer(); ?>
