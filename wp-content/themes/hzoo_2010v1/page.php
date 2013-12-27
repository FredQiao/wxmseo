<?php get_header(); ?>
<div id="wrapper">
<div id="middle" class="clearfix">
<div id="content">
<div class="postnav">
	<a href="<?php echo get_settings('home'); ?>/" title="<?php _e('Back to Home', 'mytheme'); ?>"><?php _e('Home', 'mytheme'); ?></a> &raquo; <?php the_category(', '); ?> &raquo; <?php the_title(); ?>
</div>
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
</div>

</div><!-- .post : end -->

<?php endwhile; endif; ?>
				
<?php comments_template(); ?>

<div class="sub-feed">
<a href="http://feed.feedsky.com/hzoo" target="_blank" title="订阅我的博客">+ 订阅我的博客</a>
</div>
				
</div><!-- #content : end -->

<?php get_sidebar(); ?>
</div><!-- #middle : end -->
<?php get_footer(); ?>