<?php get_header(); ?>
<div id="wrapper">
<div id="middle" class="clearfix">
<div id="content">
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<div class="post clearfix" id="post-<?php the_ID(); ?>">
<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<div class="postmeta clearfix">
	<ul>
	<!--  <li class="meta-author"><?php the_author_posts_link(); ?></li> -->
	<li class="meta-date"><?php the_time(__('F jS, Y', 'mytheme')); ?></li>	
	<li class="meta-cat"><?php the_category(', '); ?></li>
	<?php if(function_exists('the_views')) : ?><li class="meta-views"><?php the_views(); ?></li><?php endif; ?>
	<li class="meta-comments"><?php comments_popup_link(__('没有评论', 'mytheme'), __('1 条评论', 'mytheme'), __('% 条评论', 'mytheme')); ?></li>
	</ul>
</div>
<div class="content clearfix">
<?php the_content(''); ?>	
</div><!-- .content : end -->
	<p class="tags"><?php the_tags('', ', ', ''); ?></p>
	<p class="morelink"><a href="<?php the_permalink(); ?><?php if(!$post->post_excerpt) : ?>#more-<?php the_ID(); ?><?php endif; ?>" title="<?php _e('Continue reading...', 'mytheme'); ?>"><?php _e('Continue reading...', 'mytheme'); ?></a></p>
</div><!-- .post : end -->
	<?php endwhile; endif; ?>
				
				<!-- WP-PageNavi (Plugin) : START -->
				<div class="pagenavi">
					<?php if(function_exists('wp_pagenavi')) : wp_pagenavi(); else : ?>
					<p class="newer right"><?php previous_posts_link(__('New Entries', 'mytheme')); ?></p>
					<p class="older left"><?php next_posts_link(__('Older Entries', 'mytheme')); ?></p>
					<?php endif; ?>
				</div>
				<!-- WP-PageNavi (Plugin) : END -->

</div><!-- #content : end -->

<?php get_sidebar(); ?>
</div><!-- #middle : end -->
<?php get_footer(); ?>