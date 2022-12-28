<!-- Header -->
<?php get_header(); ?>

<!-- Active Sidebar -->
<?php get_sidebar('post'); ?>

<!-- Single Post -->
<?php
if ( is_single() ) :
    get_template_part('template-parts/content');
endif;
?>

<!-- Footer -->
<?php get_footer(); ?>