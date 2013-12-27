<?php
	/* HTTP Gzip */
$host = $_SERVER['HTTP_HOST'];
if ( !strstr($host, '192.168') && !strstr($host, '127.0.0') && !stristr($host, 'localhost') ) { // 本地調試不用
function wp_gzip() {
  // Don't use on Admin HTML editor
  if ( strstr($_SERVER['REQUEST_URI'], '/js/tinymce') )
    return false;
  // Can't use zlib.output_compression and ob_gzhandler at the same time
  if ( ( ini_get('zlib.output_compression') == 'On' || ini_get('zlib.output_compression_level') > 0 ) || ini_get('output_handler') == 'ob_gzhandler' )
    return false;
  // Load HTTP Compression if correct extension is loaded
  if (extension_loaded('zlib') && !ob_start('ob_gzhandler'))
    ob_start();
}
add_action('init', 'wp_gzip');
}
// -- END ----------------------------------------
	
/* Mini Pagenavi v1.0 by Willin Kan. 自定义分页   */
function pagenavi( $p = 2 ) { // 取當前页前後各 2 页
  if ( is_singular() ) return; // 文章與插页不用
  global $wp_query, $paged;
  $max_page = $wp_query->max_num_pages;
  if ( $max_page == 1 ) return; // 只有一页不用
  if ( empty( $paged ) ) $paged = 1;
  // echo '<span class="pages">Page: ' . $paged . ' of ' . $max_page . ' </span> '; // 页數
  // if ( $paged > 1 ) p_link( $paged - 1, '上一页', '«' );
  if ( $paged > $p + 1 ) p_link( 1, '最前页' );
  if ( $paged > $p + 2 ) echo '... ';
  for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { // 中間页
    if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current'>{$i}</span> " : p_link( $i );
  }
  if ( $paged < $max_page - $p - 1 ) echo '... ';
  if ( $paged < $max_page - $p ) p_link( $max_page, '最后页' );
  // if ( $paged < $max_page ) p_link( $paged + 1,'下一页', '»' );
}
function p_link( $i, $title = '' ) {
  if ( $title == '' ) $title = "第 {$i} 页";
  echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$i}</a> ";
}
// -- END ----------------------------------------

/* -----------------------------------------------
<<小牆>> Anti-Spam v1.8 by Willin Kan.
*/
//建立
class anti_spam {
  function anti_spam() {
    if ( !current_user_can('level_0') ) {
      add_action('template_redirect', array($this, 'w_tb'), 1);
      add_action('init', array($this, 'gate'), 1);
      add_action('preprocess_comment', array($this, 'sink'), 1);
    }
  }
  //設欄位
  function w_tb() {
    if ( is_singular() ) {
      ob_start(create_function('$input','return preg_replace("#textarea(.*?)name=([\"\'])comment([\"\'])(.+)/textarea>#",
      "textarea$1name=$2w$3$4/textarea><textarea name=\"comment\" cols=\"100%\" rows=\"4\" style=\"display:none\"></textarea>",$input);') );
    }
  }
  //檢查
  function gate() {
    ( !empty($_POST['w']) && empty($_POST['comment']) ) ? $_POST['comment'] = $_POST['w'] : $_POST['spam_confirmed'] = 1;
  }
  //處理
  function sink( $comment ) {
    if ( !empty($_POST['spam_confirmed']) ) {
      //方法一:直接擋掉, 將 die(); 前面兩斜線刪除即可.
      //die();
      //方法二:標記為spam, 留在資料庫檢查是否誤判.
      add_filter('pre_comment_approved', create_function('','return "spam";'));
      $is_ping = in_array( $comment['comment_type'], array('pingback', 'trackback') );
      $comment['comment_content'] = ( $is_ping ) ?
      "◎ 这是 Pingback/Trackback, 小墙怀疑这可能是 Spam!\n" . $comment['comment_content'] :
      "[ 小墙判断这是Spam! ]\n" . $comment['comment_content'];
    }
    return $comment;
  } 
}
$anti_spam = new anti_spam();
// -- END ----------------------------------------

/* UTF-8 substr() for none mb_substr() */
if ( !function_exists('mb_substr') ) {
  function mb_substr( $str, $start, $length, $encoding ) {
    return preg_replace( '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $start . '}'.
    '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $length . '}).*#s', '$1', $str);
  }
}

/* Auto-description v1.3 by Willin Kan. */
function head_meta_desc() {
  global $s, $post;
  $description = '';
  $blog_name = get_bloginfo('name');
  if ( is_singular() ) {
    if( !empty( $post->post_excerpt ) ) {
      $text = $post->post_excerpt;
    } else {
      $text = $post->post_content;
    }
    $description = trim( str_replace( array( "\r\n", "\r", "\n", "　", " "), " ", str_replace( "\"", "'", strip_tags( $text ) ) ) );
    if ( !( $description ) ) $description = $blog_name . " - " . trim( wp_title('', false) );
  } elseif ( is_home () )    { $description = $blog_name . " - " . get_bloginfo('description') . " 一个程序员出身的IT Manager，主要记录技术和生活，涉及企业管理，财务管理，hr等。"; // 首页要自己加
  } elseif ( is_tag() )      { $description = $blog_name . "有关 '" . single_tag_title('', false) . "' 的文章";
  } elseif ( is_category() ) { $description = $blog_name . "有关 '" . single_cat_title('', false) . "' 的文章";
  } elseif ( is_archive() )  { $description = $blog_name . "在: '" . trim( wp_title('', false) ) . "' 的文章";
  } elseif ( is_search() )   { $description = $blog_name . ": '" . esc_html( $s, 1 ) . "' 的搜索結果";
  } else { $description = $blog_name . "有关 '" . trim( wp_title('', false) ) . "' 的文章";
  }
  $description = mb_substr( $description, 0, 97, 'utf-8' ) . '..';
  echo "<meta name=\"description\" content=\"$description\" />\n";
}
add_action('wp_head', 'head_meta_desc');

/* Auto-keywords v1.6 by Willin Kan. */
function tags_category_to_keywords() {
  global $s, $post;
  $keywords = '';
  if ( is_single() ) {
    if ( get_the_tags( $post->ID ) ) {
      foreach ( get_the_tags( $post->ID ) as $tag ) $keywords .= $tag->name . ', ';
    }
    foreach ( get_the_category( $post->ID ) as $category ) $keywords .= $category->cat_name . ', ';
    $keywords = substr_replace( $keywords, "" , -2 );
  } elseif ( is_home () )    { $keywords = "king,月亮上的妖精,king51,IT技术,wp技巧,追求理想"; // 首页要自己加
  } elseif ( is_tag() )      { $keywords = single_tag_title('', false);
  } elseif ( is_category() ) { $keywords = single_cat_title('', false);
  } elseif ( is_search() )   { $keywords = esc_html( $s, 1 );
  } else { $keywords = trim( wp_title('', false) );
  }
  if ( $keywords ) {
    echo "<meta name=\"keywords\" content=\"$keywords\" />\n";
  }
}
add_action('wp_head', 'tags_category_to_keywords');
// -- END ----------------------------------------

if ( function_exists('register_sidebar') )
    register_sidebar();

if ( ! function_exists( 'king51_comment' ) ) :
/**
 * 嵌套评论代码.
 */
function king51_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 50 ); ?>
			<dt><?php echo get_comment_author_link(); ?></dt>
		</div><!-- .comment-author .vcard -->

		<time datetime="<?php echo get_comment_date() . '' . get_comment_time(); ?>"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php echo get_comment_date() .' '. get_comment_time(); ?></a>
		</time><?php edit_comment_link(  '(Edit)', ' ' );?><!-- .comment-meta .commentmetadata -->

		<dd class="comment-body">
			<?php if ( $comment->comment_approved == '0' ) : ?>
			<em> 您的评论等待审核。</em>
			<?php endif; ?>
			<?php comment_text(); ?>
		</dd>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p>Pingback <?php comment_author_link(); ?><?php edit_comment_link( '(Edit)', ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;
//--------End---------
// 自定义菜单
register_nav_menus(
				   array(
						 'header-menu' => __( '导航自定义菜单' )
						 )
				   );

?>