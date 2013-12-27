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

<!-- article-page start -->
<?php wp_link_pages('before=<div class="apnavi"><strong>Page: </strong>&after=</div>&next_or_number=number&link_before=<span>&link_after=</span>'); ?>
<!-- article-page end -->

<p class="tags"><?php the_tags('', ', ', ''); ?></p>
<!--<p class="forward"><a href="javascript:window.open('http://v.t.sina.com.cn/share/share.php?title='+encodeURIComponent(document.title.substring(0,76))+'&url='+encodeURIComponent(location.href)+'&rcontent=','_blank','scrollbars=no,width=600,height=450,left=75,top=20,status=no,resizable=yes'); void 0" style=”color:#000000;text-decoration:none;font-size:12px;font-weight:normal"><SPAN style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; FONT-SIZE: 12px; PADDING-BOTTOM: 0px; MARGIN-LEFT: 10px; CURSOR: pointer; PADDING-TOP: 5px"><IMG alt=转发到新浪微博 src="http://t.sina.com.cn/favicon.ico" align=absMiddle border=0>&nbsp;转发到新浪微博</SPAN></a></p>-->
</div><!-- .post : end -->

<!-- related-posts start -->
<?php if(function_exists('wp23_related_posts')) : ?>
<div class="related-posts">
<?php wp_related_posts(); ?>
</div>
<?php endif; ?>
<!-- related-posts end -->

<?php endwhile; endif; ?>
				
<?php comments_template(); ?>

<!-- postnavi start -->
<div class="postnavi">
<p class="prev"><span><?php _e('Previous post:','mytheme');?></span> <?php next_post_link('%link'); ?></p>
<p class="next"><span><?php _e('Next post:','mytheme');?></span> <?php previous_post_link('%link'); ?></p>
</div>
<!-- postnavi end -->
				
</div><!-- #content : end -->

<?php get_sidebar(); ?>
</div><!-- #middle : end -->
<?php get_footer(); ?>