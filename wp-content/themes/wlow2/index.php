<?php
/**
 * @package wlow
 */
 get_header(); ?>

	<main id="main" class="col-md-9" role="main">

		<?php if ( is_search() ) { ?>
			<h1 class="huge margin-top"><?php esc_html_e('Result for:', 'wlow'); ?> <strong><i><?php echo $s ?></i></strong></h1>
		<?php } else  if ( is_category() || is_tag() ) { ?>
			<h1 class="huge margin-top"><?php echo single_cat_title() ?></h1>
		<?php } else if ( is_home() ){ ?>
			<h1 class="huge"><?php single_post_title(); ?></h1>
		<?php } else if ( is_date() ){ ?>
			<h1 class="huge margin-top"><?php single_month_title(' '); ?> </h1>
		<?php } else if ( is_archive() ){ ?>
			<h1 class="huge margin-top"><?php post_type_archive_title(); ?> </h1>
		<?php } ?>

		<?php if (have_posts()) :?><?php while(have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="content-article">

					<h2 class="large"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p class="meta"> <i class="fa fa-clock-o"></i> <?php the_time('j M , Y') ?> <i class="fa fa-thumb-tack"></i> <strong>	<?php the_category(','); ?></strong></p>


					 <a href="<?php the_permalink(); ?>" class="link-article">
				        <?php the_post_thumbnail('wlow_single', array('class' => 'img-res','alt' => get_the_title())); ?>
				     </a>


					<?php the_excerpt();?>


					<?php $post_tags = wp_get_post_tags($post->ID); if(!empty($post_tags)) { ?>
						<p><span class="tag"> <i class="fa fa-tag"></i> <?php the_tags('', ', ', ''); ?> </span></p>
					<?php } ?>

				</div>

				<div class="clearfix"></div>

			</article>

		<?php endwhile; ?>

			<?php get_template_part('inc/pagination'); ?>

        <?php else : ?>

            <h3><?php esc_html_e('Sorry, no posts matched your criteria.', 'wlow'); ?></h3>
            <p><?php esc_html_e('Try to make a search...', 'wlow'); ?></p>

			<?php get_search_form(); ?>

			<div class="spacer"></div>

        <?php endif; ?>

	</main>

	<?php get_sidebar(); ?>


<?php get_footer(); ?>
