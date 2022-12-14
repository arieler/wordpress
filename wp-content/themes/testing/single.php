<?php bloginfo( 'version' );?> 

<?php get_search_form();?>
<?php get_template_part( 'featured-content' ); ?>


<?php

/* 

has_excerpt()
the_excerpt()

the_title();
the_content();

is_preview() 
has_nav_menu() 
is_dynamic_sidebar() 
is_active_sidebar() 
is_active_widget( $widget_callback, $widget_id ) {}

next_post()
previous_post()

wp_list_cats()
wp_list_pages()

$post_type = get_post_type( get_queried_object_id() );

*/

?>


<?php echo get_theme_file_uri( 'images/logo.png' );?>

<a href="<?php echo get_permalink($ID); ?>">This is a link</a>


<!-- One Post -->