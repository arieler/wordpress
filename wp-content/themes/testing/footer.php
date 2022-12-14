    <!-- Footer-->
    <footer class="footer py-4">
		<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<!-- .START footer-navigation -->
            <nav aria-label="<?php esc_attr_e( 'Secondary menu', 'crtheme' ); ?>" 
                class="footer-navigation">
                <ul class="footer-navigation-wrapper">
					<?php
					wp_nav_menu([
                        'theme_location' => 'footer',
                        'items_wrap' => '%3$s',
                        'container' => false,
                        'depth' => 1,
                        'link_before' => '<span>',
                        'link_after' => '</span>',
                        'fallback_cb' => false,
                    ]);
					?>
				</ul>			
            </nav>
            <!-- END .footer-navigation -->
		<?php endif; ?>
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-3 text-lg-start"><?php echo custom_footer_output(); ?></div>
				<div class="col-lg-3 my-3 my-lg-0">
					<a class="btn btn-dark btn-social mx-2" href="#!"
					><i class="fab fa-twitter"></i
					></a>
					<a class="btn btn-dark btn-social mx-2" href="#!"
					><i class="fab fa-facebook-f"></i
					></a>
					<a class="btn btn-dark btn-social mx-2" href="#!"
					><i class="fab fa-linkedin-in"></i
					></a>
				</div>
				<div class="col-lg-3 text-lg-end">
					<?php
						if ( function_exists( 'the_privacy_policy_link' ) ) {
							the_privacy_policy_link( '<div class="link-dark text-decoration-none me-3">', '</div>' );
						}
					?>
					<a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
				</div>
			</div>
		</div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
	
	<?php wp_footer(); ?>
  
	</body>
</html>