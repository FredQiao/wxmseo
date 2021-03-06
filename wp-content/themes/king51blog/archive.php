<?php get_header(); ?>

	<?php if (have_posts()) : ?>

 	  	<?php if (is_day()) { ?>
		<h5 class="clear"><?php the_time('Y年n月j日'); ?>的日志</h5>
		
	 	<?php } elseif (is_month()) { ?>
		<h5 class="expage"><?php the_time('Y年n月'); ?>的日志</h5>

		<?php } elseif (is_year()) { ?>
		<h5 class="expage"><?php the_time('Y年'); ?>的日志</h5>

		<?php } elseif (is_author()) { ?>
		<h5 class="expage">Archives by author</h5>
			
		<?php } elseif (is_tag()) { ?>
		<h5 class="expage">关键字：<?php echo single_cat_title(); ?> 的日志</h5>
		<?php } ?>
				
		<?php while (have_posts()) : the_post(); ?>

			<article>
				<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<small>
					<time datetime="<?php the_time('Y-N-j\TG:H:m')?>"><?php the_time('Y-n-j g:h A') ?></time> in  <?php the_category(', ') ?> | <?php comments_popup_link('没有评论', '仅一条评论', '% 条评论', 'commentslink', __('评论关闭')); ?>
				</small>
				<div class="content">
					<?php the_excerpt('完整内容...'); ?>
				</div>
				<p>关键字: <?php the_tags('',',', ''); ?> <?php edit_post_link('Edit', '', ''); ?></p>
			</article>
			<div class="clear"></div>
				
		<?php endwhile; ?>

	<?php else : ?>

		<h2 class="expage">抱歉，未发现任何内容</h2>
		
		<h3>搜索一下吧：）</h3>
		
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>

	<?php endif; ?>
    
		<nav class="pagebar">
			<?php if (function_exists('wp_pagebar')): ?>
				<?php wp_pagebar() ?>
			<?php else : ?>
				<span class="newer"><?php previous_posts_link(__('Newer Entries', 'inove')); ?></span>
				<span class="older"><?php next_posts_link(__('Older Entries', 'inove')); ?></span>
			<?php endif; ?>
		</nav>
	

		
	<?php get_sidebar(); ?>
	<?php get_footer(); ?>