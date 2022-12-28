<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-shrink" id="mainNav">
	<div class="container">
		<a class="navbar-brand" href="#page-top"
			>
			<?php echo custom_logo_output(); ?>
		</a>
		<button
			class="navbar-toggler"
			type="button"
			data-bs-toggle="collapse"
			data-bs-target="#navbarResponsive"
			aria-controls="navbarResponsive"
			aria-expanded="false"
			aria-label="Toggle navigation"
		>
			Menu
			<i class="fas fa-bars ms-1"></i>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
				<li class="nav-item">
					<a class="nav-link" href="#services">Services</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#blog">Blog</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#contact">Contact</a>
				</li>
			</ul>
		</div>
	</div>
</nav>


<!-- <div id="sidebar-foooter" class="sidebar">-->
    <?php do_action( 'before_sidebar' ); ?>

    <?php if ( is_active_sidebar("sidebar-1") ) : ?>
		<?php dynamic_sidebar( ); ?>
	<?php else : ?>
		<!-- Time to add some widgets! -->
	<?php endif; ?>
<!-- </div> -->