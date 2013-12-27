<?php

 // Do not delete these lines
	if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	
	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'mytheme'); ?></p> 
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<div id="comments" class="clearfix">
<?php if ( have_comments() ) : ?>

	<?php if (comments_open()) : ?>
	<!-- If comments are open, but there are no comments. -->
	<h4><?php comments_number(__('No Responses To This Post So Far', 'mytheme'), __('1 Response To This Post So Far', 'mytheme'), __('% Responses To This Post So Far', 'mytheme'));?><?php comments_rss_link(__('(Rss)','mytheme'));  ?></h4>
	<?php else : // comments are closed ?>
	<!-- If comments are closed. -->
	<h4><?php comments_number(__('No Responses To This Post So Far', 'mytheme'), __('1 Response To This Post So Far', 'mytheme'), __('% Responses To This Post So Far', 'mytheme'));?><?php comments_rss_link(__('(Rss)','mytheme')); _e('Comments closed.','mytheme') ?></h4>
	<?php endif; ?>

<ol class="commentlist">
<?php $comment_serial = 1 ?>
<?php wp_list_comments('type=comment&callback=junior_comment_callback'); ?>
</ol>
<?php 
$comment_pages = paginate_comments_links('echo=0');
if($comment_pages) : ?>
<div class="cpnavi"><?php echo $comment_pages; ?></div>
<?php endif; ?>

<?php else : // this is displayed if there are no comments so far ?>
<?php if ( comments_open() ) : ?>
<!-- If comments are open, but there are no comments. -->
<h4><?php comments_number(__('No Responses To This Post So Far', 'mytheme'), __('1 Response To This Post So Far', 'mytheme'), __('% Responses To This Post So Far', 'mytheme'));?><?php comments_rss_link(__('(Rss)','mytheme'));  ?></h4>
<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<h4><?php _e('Sorry comments on this post are closed.', 'mytheme'); ?></h4>
<?php endif; ?>
<?php endif;?>

<div id="respond"> 
<?php if (comments_open()) : ?>				
<h5><?php comment_form_title( __('Leave a Reply', 'mytheme')); ?></h5>
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<h5><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'kubrick'), wp_login_url( get_permalink() )); ?></h5>
<?php else : ?>
		  
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform"> 

<?php if ( $user_ID ) : ?>

<p><?php printf(__('Logged in as <a href="%1$s">%2$s</a>.', 'mytheme'), get_option('siteurl') . '/wp-admin/profile.php', $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'mytheme'); ?>"><?php _e('Log out &raquo;', 'mytheme'); ?></a></p>

<?php else : ?>				  	
<p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" /> 
<label for="author"><?php _e('Name', 'mytheme'); ?> <?php if ($req) _e("(required)", "mytheme"); ?></label></p>

<p><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" /> 
<label for="email"><?php _e('Mail (will not be published)', 'mytheme'); ?> <?php if ($req) _e("(required)", "mytheme"); ?></label></p> 

<p><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="3" /> 
<label for="url"><?php _e('Website', 'mytheme'); ?></label></p> 

<?php endif; ?>					 
<p><textarea name="comment" id="comment"  rows="7" tabindex="4"></textarea></p> 
<p><input type="submit" class="submit" name="submit" id="submit" tabindex="5" value="<?php _e('+ Submit Comment', 'mytheme'); ?>" /> 
<?php comment_id_fields(); ?>
<?php do_action('comment_form', $post->ID); ?>
<span class="cancel"><?php cancel_comment_reply_link(); ?></span>
</p> 
</form>
<?php endif; // If registration required and not logged in ?>
<?php endif; // if you delete this the sky will fall on your head ?>
</div><!-- #respond : end -->
</div>