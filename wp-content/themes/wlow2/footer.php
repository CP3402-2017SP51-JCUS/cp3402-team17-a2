<?php
/**
 * @package wlow
 */
?>


<?php if (!is_front_page()){ ?>

	</div><!-- /.row -->

</div><!-- /.container -->

<?php } ?>

		<footer class="col-md-12 no-margin">

			<div class="footer">

				<div class="container">

					<div class="row">
						<div class="col-md-6">
							<p><?php esc_html_e('&copy; Copyright ', 'wlow'); ?> <?php echo date("o");?>   <?php bloginfo('name'); ?>  </p>
						</div>
						<div class="col-md-6">
							<p class="alignright"> <a href="#top"><i class="fa fa-angle-double-up"></i> Top</a></p>
						</div>
					</div>

				</div>

			</div>

		</footer>



	</div><!-- end content for slide effect -->
</div><!-- end container for slide effect -->

<?php wp_footer();?>

</body>
</html>
