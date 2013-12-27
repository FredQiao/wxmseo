<?php get_header(); ?>
<div id="wrapper">
<div id="middle" class="clearfix">
<div id="content">

<div class="post 404" >
<h2 class="title"><?php _e('No Found This Page!','mytheme')?></h2>

<div class="content clearfix">
<p><?php _e('Sorry but we can&rsquo;t find the right page you&rsquo;re looking for.','mytheme'); ?></p>
<p></p>
<p><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a></p>
</div><!-- .content : end -->

</div><!-- .post : end -->
	
				
</div><!-- #content : end -->

<?php get_sidebar(); ?>
</div><!-- #middle : end -->
<?php get_footer(); ?>