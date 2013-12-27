<?php get_header(); ?>

			<article>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<h2 class="page-title" id="post-<?php the_ID(); ?>"><?php the_title(); ?></h2>
					<?php the_content('Read on &raquo;'); ?>
					<?php wp_link_pages(); ?>
					<?php edit_post_link(__('【编辑此页面】'), '<p style="font-size:12px">', '</p>'); ?>
				
				<?php endwhile; endif; ?>
			</article>
			<?php comments_template(); ?>
			<div class="clear"></div>
<?php get_sidebar(); ?>

<?php get_footer(); ?>
