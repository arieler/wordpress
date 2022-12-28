<div class="row mt-5">
	<article id="post-<?php the_ID(); ?>" class="col-9" <?php get_post_classes(); ?>>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title default-max-width">', '</h1>' ); ?>

			<?php the_post_thumbnail(); ?>
		</header>

		<div class="entry-content">
			<?php the_content(); ?>
		</div>

		<footer class="entry-footer default-max-width">
			POST TITLE: <?php the_title(); ?><br />
			AUTHOR: <?php the_author(); ?><br />
			POSTED: <?php the_time('jS F Y') ?><br />
			FILED AS: <?php the_category(', ') ?><br />
			COMMENT FEED: <?php comments_rss_link('RSS 2.0'); ?><br />
			PREVIOUS: <?php previous_post('%', '', 'yes', 'yes'); ?><br />
			NEXT: <?php next_post('%', '', 'yes', 'yes'); ?>
		</footer>
	</article>
	<div class="sidebar col-3"></div>
</div>