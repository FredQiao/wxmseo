<?php
/**
 * The template for displaying Comments.
 */
?>
<article>
	 <header class="commhead">
		<?php if ( post_password_required() ) : ?>
				<p>本文已启用密码保护。输入密码可以查看评论。</p>
	</header><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>
<?php
	// You can start editing here -- including this comment!

	 if ( have_comments() ) : ?>
		<span class="right"><a href="#addcomment" onclick="return _$ff()" title="<?php _e("Leave a comment"); ?>">发表评论 &raquo;</a></span>
	<?php comments_number("没有评论","一条评论", "共有% 条评论"); ?> 	
	</header>
		 <div class="commentList">
		 <?php 	wp_list_comments( array( 'callback' => 'king51_comment') ); ?>
		 </div>
		 	 
		 <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // 评论分页选项打开，并且 > 1 页 ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link(  '<span class="meta-nav">&larr;</span> 更早的'); ?></div>
				<div class="nav-next"><?php next_comments_link( '最新的 <span class="meta-nav">&rarr;</span>'); ?></div>
			</div><!-- .评论分页 -->
		<?php endif; // check for comment navigation 

	 else : // or, if we don't have comments:
	 ?>
	 还没有评论哦，赶快抢沙发~~
	</header>
	<?php
	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p class="nocomments">评论关闭了.</p>
<?php endif; // end ! comments_open() ?>

	<?php endif; // end have_comments() ?>

<?php comment_form(); ?>
</article>