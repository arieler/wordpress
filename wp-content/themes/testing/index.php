<!-- Header -->
<?php get_header(); ?>

<!-- Active Sidebar -->
<?php get_sidebar(); ?>

<!-- Multiple Posts -->
<?php
if ( is_front_page() && is_home() ) :
	get_template_part('template-parts/blog');
?>

<?php
endif;
?>

<!-- Footer -->
<?php get_footer(); ?>