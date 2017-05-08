<?php /* Latest News */

global $wp_customize;

/* Retrive fields */
$wlow_home_latest_news_title = get_theme_mod('wlow__home__latest-news__title',__('News','wlow'));
$wlow_home_latest_news_subtitle = get_theme_mod('wlow__home__latest-news__subtitle',__('Our Latest News','wlow'));

?>

<section class="cards clearfix">
	<span class="anchor" id="latest-news"></span>
	<div class="container">
		<div class="row">
			<?php
			/* Title */
			if( !empty($wlow_home_latest_news_title) ){
				echo '<h2 class="cards__intro-title">'. $wlow_home_latest_news_title .'</h2>';
			}

			/* Subtitle */
			if( !empty($wlow_home_latest_news_subtitle) ){
				echo '<h3 class="cards__intro-subtitle">'. $wlow_home_latest_news_subtitle .'</h3>';
			}
			?>

			<?php
			$args = array(
			  'post_type' => 'post',			// Post Type
			  'posts_per_page' => 3,		// Number of posts
			);

			$loopPosts = new WP_Query($args);

			if ($loopPosts->have_posts()) : while($loopPosts->have_posts()) : $loopPosts->the_post(); ?>

				<div class="col-sm-4 card">

					<?php the_post_thumbnail('medium', array('class' => 'img-res','alt' => get_the_title())); ?>

					<h3 class="card__title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
					<div class="card__meta">

							<i class="fa fa-clock-o"></i> <?php the_time('j M , Y') ?> &nbsp; <i class="fa fa-thumb-tack"></i> <?php the_category(','); ?>

				  </div>

					<?php the_excerpt(); ?>

				</div>

			<?php endwhile;  else:  endif; ?>

		</div>
	</div>
</section>
