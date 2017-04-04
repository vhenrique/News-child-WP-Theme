<?php get_header(); ?>
	<?php if(have_posts()): while(have_posts()): the_post(); ?>
		<h1 class="page-title"><?php the_title(); ?></h1>
		<div class="entry">
			<?php
				the_content();
				wp_link_pages(array('before' => '<p class="post-pagination"><span>Páginas</span>', 'after' => '</p>'));
			?>
		</div>
	<?php endwhile; else: ?>
		<p class="msg-info"><?php _e('Sorry, no records were found','lang'); ?></p>
	<?php endif; ?>
<?php get_footer(); ?>