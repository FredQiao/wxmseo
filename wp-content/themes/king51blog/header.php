<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   	<title><?php wp_title("");?> <?php if (is_home()) { bloginfo('name');}?></title>
    <meta name="robots" content="all" />
	<meta name="google-site-verification" content="_WjpH7nP5HPwJMhtQ4RAfYpQtKbaM_iSKh3j4lz0Odg" />
	<link type="text/css" rel="stylesheet" href="<?php bloginfo('stylesheet_url');?>">
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo(’name’);?>" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
		<!--[if IE]>	<script src="<?php bloginfo('template_url'); ?>/js/html5.js" type="text/jscript"></script><![endif]-->
  	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<?php if ( is_singular() ){ ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
<?php } ?>
</head>
<body>  
<div id="awloading">
		<div id="awlfull">
		</div>
		<div id="awlpercent">
		</div>
		<div id="awlt">
			正在加载...
		</div>
		</div>
<!--头部开始--> 
<header class="header row">
    <hgroup class="col col_16 logo">
    	<h1><a href="<?php bloginfo('home');?>" title="<?php bloginfo('name');?>"><?php bloginfo('name'); ?></a></h1>
    	<h6><?php bloginfo('description');?></h6>
    </hgroup> 
    <div class="clear"></div>
   
  <!--导航开始-->
 
			   <?php wp_nav_menu( array( 'theme_location' => 'header-menu','container' => 'nav' , 'container_class' => 'nav' ) ); ?>
     
</header>
<div class="clear"></div>
<script type="text/javascript">$("#awlpercent").animate({"width":"40px"});</script>
<section class="row">
<!-- content -->
	<section class="content col_12 col">