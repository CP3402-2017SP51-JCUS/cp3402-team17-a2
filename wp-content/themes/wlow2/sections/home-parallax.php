
	<?php
		
		/* One Page Mode On */
		$wlow_onepage = get_theme_mod('wlow__home__onepage__on', false);
		
		if( isset($wlow_onepage) && $wlow_onepage == true ) { 
			$wlow_onepage = true; 
		} 

		/*-----------------------------
		* Fetaured Image Url
		*-----------------------------*/
		$image_attributes =  wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'wlow_big' );

	?>

	<section class="parallax parallax-background" style="background: url(<?php echo $image_attributes[0]; ?>) no-repeat top center fixed; background-size: cover;">
		<span class="anchor" id="<?php echo $post->post_name; ?>"></span>
		<div class="parallax__filter"></div>
		<div class="parallax__caption">
			<div class="container">
				<div class="dash dash--light"></div>

				<h3 class="parallax__caption__title huge">
					
					<?php if ($wlow_onepage != true) { ?><a href="<?php the_permalink(); ?>"><?php } ?>
						
						<?php the_title(); ?>
					
					<?php if ($wlow_onepage != true) { ?></a><?php } ?>
					
				</h3>
				
				<div class="parallax__caption__copy">
					
					<?php if ($wlow_onepage != true) { ?>
	        	<?php the_excerpt(); ?>
	        <?php } else { ?>
	        	<?php the_content(''); ?>
	        <?php } ?>
	        
				</div>
				
				<?php if ($wlow_onepage != true) { ?>
				
					<a class="button animate" href="<?php the_permalink(); ?>"><?php esc_html_e('Discover More', 'wlow' ); ?></a>
				
				<?php } ?>
				
			</div>
		</div>
	</section>
