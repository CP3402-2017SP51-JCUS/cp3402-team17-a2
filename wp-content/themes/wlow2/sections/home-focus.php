<section class="focus">
	<span class="anchor" id="focus"></span>
	<div class="container">
		<div class="row">

			<?php 
				
			/* Focus 
			-----------------------------*/
			
			/* One Page Mode On */
			$wlow_onepage = get_theme_mod('wlow__home__onepage__on', false);
			
			if( isset($wlow_onepage) && $wlow_onepage == true ) { 
				$wlow_onepage = true; 
			} 
			
			
			$focus = new WP_Query( array(
				'post_type'			=> 'page',
				'no_found_rows' 	=> true,
				'post_status'   	=> 'publish',
				'orderby' => 'menu_order',
    	  'order' => 'ASC', 
				'posts_per_page' 	=> 3,
		        'meta_query' => array(
		            array(
		                'key' => '_wp_page_template',
		                'value' => 'page-templates/focus.php',
		            )
		        )			
			) ); ?>
			
			<?php if ($focus->have_posts()) : while($focus->have_posts()) : $focus->the_post(); ?>

				<div class="col-sm-4">
					<div class="focus__item">
						
						<?php
							
							/*-----------------------------
							* Fetaured Image Url
							*-----------------------------*/
							$image_attributes =  wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'wlow_square' );
						
						?>
		
						<?php if ($wlow_onepage != true) { ?><a href="<?php the_permalink(); ?>"><?php } ?>
						
		    			<img class="img-res img-round" src="<?php echo $image_attributes[0]; ?>" alt="<?php the_title(); ?>" />
		    		
		    		<?php if ($wlow_onepage != true) { ?></a><?php } ?>
		
		        <h3 class="focus__item__title">
			        
			        <?php if ($wlow_onepage != true) { ?><a href="<?php the_permalink(); ?>"><?php } ?>
			        
				        <?php the_title(); ?>
				        
				      <?php if ($wlow_onepage != true) { ?></a><?php } ?>
				      
				    </h3>
		
		        <div>
			        <?php if ($wlow_onepage != true) { ?>
			        	<?php the_excerpt(); ?>
			        <?php } else { ?>
			        	<?php the_content(''); ?>
			        <?php } ?>
			      </div>
		        
					</div>
		    </div>

	    <?php endwhile; endif; ?>

		</div>
	</div>
</section>
