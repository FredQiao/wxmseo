<?php
 
 load_theme_textdomain( 'mytheme' , get_template_directory().'/languages' );
if(function_exists('register_sidebar')) :
	register_sidebar(array('name' => __('sidebar-index','mytheme'), 'id'=>'sidebar-index', 'description' => __( 'The Index (primary) widget area, most often used as a sidebar.', 'mytheme' ), 'before_widget' => '<div class="widget box">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>',));
	register_sidebar(array('name' => __('sidebar-index-left','mytheme'), 'id'=>'sidebar-index-left', 'description' => __( 'The Index left widget area, most often used as a sidebar.', 'mytheme' ), 'before_widget' => '<div class="widget box">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>',));
	register_sidebar(array('name' => __('sidebar-index-right','mytheme'), 'id'=>'sidebar-index-right', 'description' => __( 'The Index left widget area, most often used as a sidebar.', 'mytheme' ), 'before_widget' => '<div class="widget box">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>',));
endif;


// create document title
function theme_title() {
	
	$site_name = get_bloginfo('name');
	$separator = '|';
	
	if(is_single()) {
		$content = single_post_title('', FALSE);
	} elseif(is_home() || is_front_page()) {
		$content = get_bloginfo('description');
	} elseif(is_page()) {
		$content = single_post_title('', FALSE);
	} elseif(is_search()) {
		$content = 'Search Result for:';
		$content .= ' ' . wp_specialchars(stripslashes(get_search_query()), true);
	} elseif(is_category()) {
		$content = 'Category Archives:';
		$content .= ' ' . single_cat_title("", false);
	} elseif(is_tag()) {
		$content = 'Tag Archives:';
		$content .= ' ' . mytheme_tag_query();
	} elseif(is_404()) {
		$content = 'Not Found';
	} else {
		$content = get_bloginfo('description');
	}
	
	if(get_query_var('paged')) {
		$content .= ' ' . $separator . ' ';
		$content .= 'Page';
		$content .= ' ';
		$content .= get_query_var('paged');
	}
	
	if($content) {
		if(is_home() || is_front_page()) {
			$elements = array(
				'site_name' => $site_name,
				'separator' => $separator,
				'content' => $content
			);
		} else {
			$elements = array(
				'content' => $content,
				'separator' => $separator,
				'site_name' => $site_name
			);
		}
	} else {
		$elements = array(
			'site_name' => $site_name
		);
	}
	
	$elements = apply_filters('mytheme_doctitle', $elements);
	
	if(is_array($elements)) {
		$doctitle = implode(' ', $elements);
	} else {
		$doctitle = $elements;
	}
	
	echo $doctitle;
	
}
// create nice multi tag title
function mytheme_tag_query() {

	$nice_tag_query = get_query_var('tag');
	$nice_tag_query = str_replace(' ', '+', $nice_tag_query);
	$tag_slugs = preg_split('%[,+]%', $nice_tag_query, -1, PREG_SPLIT_NO_EMPTY);
	$tag_ops = preg_split('%[^,+]*%', $nice_tag_query, -1, PREG_SPLIT_NO_EMPTY);
	
	$tag_ops_counter = 0;
	$nice_tag_query = '';
	
	foreach($tag_slugs as $tag_slug) {
		$tag = get_term_by('slug', $tag_slug, 'post_tag');
		
		if($tag_ops[$tag_ops_counter] == ',') {
			$tag_ops[$tag_ops_counter] = ', ';
		} elseif($tag_ops[$tag_ops_counter] == '+') {
			$tag_ops[$tag_ops_counter] = ' + ';
		}
		
		$nice_tag_query = $nice_tag_query . $tag -> name . $tag_ops[$tag_ops_counter];
		$tag_ops_counter += 1;
	}
	
	return $nice_tag_query;

}
?>
<?php 
function __popular_posts($no_posts=6, $before="<li>", $after="</li>", $show_pass_post=false, $duration="") {
	global $wpdb;
	$request="SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";
	if(!$show_pass_post) $request .= " AND post_password =\"\"";
	if($duration !="") { 
		$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
	}
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
	$posts=$wpdb->get_results($request);
	$output="";
	if ($posts) {
		foreach ($posts as $post) {
			$post_title=stripslashes($post->post_title);
			$comment_count=$post->comment_count;
			$permalink=get_permalink($post->ID);
			$output .= $before . " <a href=\"" . $permalink . "\" title=\"" . $post_title."\">" . $post_title . "</a> " . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
	return  $output;
}

 function junior_comment_callback($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; 
   global $comment_serial;
   $comment_serial++;
   ?>
   <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
     <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
      <div class="comment-author vcard">
         <?php echo get_avatar( $comment, 32 ); ?>
         <cite><?php echo get_comment_author_link()?> | <a href="<?php comment_link();?>">#<?php echo $comment_serial; ?></a></cite>
        <div class="comment-meta"> <?php printf('%1$s at %2$s', get_comment_date(),  get_comment_time()) ?> <?php edit_comment_link(__('(Edit)'),'  ','') ?> </div>  
        <div class="reply"><?php comment_reply_link(array_merge( $args, array('add_below' => 'div-comment','reply_text'=> '&nbsp;', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
      </div><!-- .comment-author : end -->
          
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.') ?></em>
         <br />
      <?php endif; ?>
	 <div class="message">
	 <div>
      <?php comment_text() ?>
      </div>
      </div>

     </div><!-- .comment-body : end -->   
<?php
}
//remove plugin WP-PageNavi stylesheet
remove_action('wp_print_styles', 'pagenavi_stylesheets');
?>
