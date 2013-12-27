<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<nav>
			<span class="left"><?php next_post_link('&laquo; %link') ?></span>
			<span class="right"><?php previous_post_link('%link &raquo;') ?></span>
		</nav>
		<div class="clear"></div>
		
		<article>
			<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<div class="content">
			<?php the_content(); ?>
			</div>
			<p>关键字: <?php the_tags('',',', ''); ?> <?php edit_post_link('Edit', '', ''); ?></p>
				<footer class="center">
					<time datetime="<?php the_time('Y-N-j\TG:H:m')?>"><?php the_time('Y-n-j g:h A') ?></time>
					  贴于 <?php the_category(', ') ?>. 
					  引用通告地址：<a href="<?php the_permalink() ?>/trackback/"><?php the_permalink() ?>/trackback/</a>
				</footer>
		</article>
        
	<?php comments_template(); ?>
	<?php endwhile; else : ?>
		<h2>Nothing here</h2>
		<h3>Search</h3>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
		<?php endif; ?>
<?php get_sidebar(); ?>

	</section><!-- end wrap -->

<?php get_footer(); ?>