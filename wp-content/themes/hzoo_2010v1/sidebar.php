<div id="sidebar" >
<div class="sidebar">

	<div class="widget box">
	<h3>音乐推荐</h3>	
<script type="text/javascript"><!--
google_ad_client = "pub-5520850669287639";
/* 200x200, 创建于 10-9-11 */
google_ad_slot = "3469850917";
google_ad_width = 200;
google_ad_height = 200;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>		
        </div>

	<div class="widget box">
	<h3>最新评论</h3>			
		<ul> 
	<?php wp_recentcomments('limit=8&length=11&post=false'); ?>
		</ul>
        </div>
        
    <div class="widget box">
	<h3>最新文章</h3>			
		<ul class="newbox"> 
	<?php wp_get_archives('type=postbypost&limit=10'); ?>
		</ul>
        </div>
        
    <div class="widget box">
	<h3>标签云集</h3>			
		<ul class="tagsindex"> 
	 <?php wp_tag_cloud('smallest=10&largest=14&'); ?>
		</ul>
        </div>
        
    <div class="widget box">
	<h3>文章索引</h3>			
		<ul class="monthlybox"> 
	<?php wp_get_archives('type=monthly'); ?>
		</ul>
        </div>

    <div class="widget box">
     <?php get_links_list(); ?>
        </div>
        
    <div class="widget box">
	<h3>管理功能</h3>			
		<ul> 
	<?php wp_register(); ?>
	<li><?php wp_loginout(); ?></li>
	<?php wp_meta(); ?>
		</ul>
     </div>
</div>
</div><!-- #sidebar : end -->