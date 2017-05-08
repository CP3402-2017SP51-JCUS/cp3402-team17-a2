<?php
/**
 * Template Name: Panel Left
 *
 * @package wlow
 */
 get_header(); ?>

	<main id="main" class="col-md-9" role="main">

		<?php if (have_posts()) :?><?php while(have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="content-article">

					<h1 class="huge margin-bottom"><?php the_title(); ?></h1>

					<?php if ( has_post_thumbnail() ) { ?>
		        <?php the_post_thumbnail('wlow_single', array('class' => 'img-res','alt'	=> get_the_title())); ?>
		      <?php } ?>

		      <?php the_content(esc_html__('Read More...', 'wlow'));?>

				</div>

			</article>

		<?php endwhile; ?>
        <?php else : ?>

                <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'wlow'); ?></p>

        <?php endif; ?>

	</main>

	<?php get_sidebar(); ?>

<?php get_footer(); ?>