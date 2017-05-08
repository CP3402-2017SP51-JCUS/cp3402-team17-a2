

<section class="panel-side clearfix">
	<span class="anchor" id="<?php echo $post->post_name; ?>"></span>
	<div class="col-sm-6 col-sm-push-6 no-margin">

	<?php
		
	/* One Page Mode On */
	$wlow_onepage = get_theme_mod('wlow__home__onepage__on', false);
	
	if( isset($wlow_onepage) && $wlow_onepage == true ) { 
		$wlow_onepage = true; 
	} 

	/*-----------------------------
	* Fetaured Image Url
	*-----------------------------*/
	$image_attributes =  wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'wlow_single' );

	?>
	
	<?php if ($wlow_onepage != true) { ?><a href="<?php the_permalink(); ?>"><?php } ?>
	
		<div class="panel-side__fill parallax-image" style="background: url(<?php echo $image_attributes[0]; ?>) center center; -webkit-background-size: cover;"></div>
		</div>
		
	<?php if ($wlow_onepage != true) { ?></a><?php } ?>
	
	<div class="col-sm-6 col-sm-pull-6">
		<div class="panel-side__content">
			<div class="panel-side__content__copy">
				<div class="dash"></div>
				
					<h3 class="panel-side__content__copy__title">
						
						<?php if ($wlow_onepage != true) { ?><a href="<?php the_permalink(); ?>"><?php } ?>
							
							<?php the_title(); ?>
						
						<?php if ($wlow_onepage != true) { ?></a><?php } ?>
					
					</h3>
					
					<?php if ($wlow_onepage != true) { ?>
	        	<?php the_excerpt(); ?>
	        <?php } else { ?>
	        	<?php the_content(''); ?>
	        <?php } ?>
					
					<?php if ($wlow_onepage != true) { ?>
					
						<a class="button animate button--small" href="<?php the_permalink(); ?>"><?php esc_html_e('Discover More', 'wlow' ); ?></a>
					
					<?php } ?>


				</div>
		</div>
	</div>
</section>
