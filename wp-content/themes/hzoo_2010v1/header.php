<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title><?php theme_title(); ?></title>
	<meta name="description" content="浩子窝窝 - 这是一个个人的博客用来记录与分享生活中的点点滴滴" />
	<meta name="keywords" content="浩子,浩子窝窝,生活故事,平面设计,FLASH设计,文浩权,mouse,haozii" />
	<!-- description and keywords end -->
	
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="shortcut icon" href="<?php bloginfo('url'); ?>/favicon.ico" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> 
<?php wp_head(); ?>
</head> 
<body <?php body_class(); ?>>
<div id="header">
<div class="wrapperhearder">
		<ul class="pages box">
                <li class="rssfeed"><a href="http://feed.feedsky.com/hzoo" target="_blank" title="RSS订阅">RSS</a></li>
            	<li class="mail"><a href="http://www.feedsky.com/msub_wr.html?burl=hzoo" target="_blank" title="邮件订阅本站">MAIL</a></li>
				<?php wp_list_pages('title_li='); ?>
			<li class="home <?php echo (is_home() ? 'current_page_item' : ''); ?>"><a href="<?php echo get_option('home'); ?>"><?php _e('Home','mytheme');?></a></li>

		</ul>
<div id="logo">
<a href="<?php echo get_option('home'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" border="0"></a>
</div>

<form action="<?php echo get_option('home'); ?>/">
	<input type="text" name="s" id="s" value="<?php the_search_query(); ?>" />
	<button type="submit">Submit</button>
</form>

</div>
		<div id="navibg">
			<ul class="navigation box">
<li class="home <?php echo (is_home() ? 'current_page_item' : ''); ?>"><a href="<?php echo get_option('home'); ?>"><?php _e('Home','mytheme');?></a></li>
				<?php wp_list_categories('title_li='); ?>
			</ul>
         </div>
</div><!-- #header : end -->