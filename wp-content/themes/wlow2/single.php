<?php get_header(); ?>

	<main  id="main" class="col-md-9" role="main">

		<?php if (have_posts()) :?><?php while(have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="content-article">

					<h1 class="huge"><?php the_title(); ?></h1>

					<p class="meta">
						<i class="fa fa-clock-o"></i> <?php the_time('j M , Y') ?>
						<i class="fa fa-thumb-tack"></i> <strong>	<?php the_category(','); ?></strong>
				    </p>

					<?php the_post_thumbnail('wlow_single', array('class' => 'img-res','alt' => get_the_title())); ?>

					<?php the_content(esc_html__('Read More...', 'wlow'));?>
					<?php wp_link_pages('pagelink=Page %'); ?>


					<?php $post_tags = wp_get_post_tags($post->ID); if(!empty($post_tags)) {?>
						<p class="cont-tag"><span class="tag"> <i class="fa fa-tag"></i> <?php the_tags('', ', ', ''); ?> </span></p>
					<?php } ?>


					<hr />

					<div id="comments">
						<?php comments_template(); ?>
					</div>

				</div>

			</article>

		<?php endwhile; ?>
	    <?php else : ?>

	        <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'wlow'); ?></p>

	    <?php endif; ?>

	</main>


	<?php get_sidebar(); ?>


<?php get_footer(); ?>
