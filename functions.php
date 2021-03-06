<?php
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/admin/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/admin/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/admin/config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/admin/config.php' );
}
add_theme_support( 'post-thumbnails' );
add_theme_support( 'post-formats' );   
    //参数feature可以使下列内容   
    //'post-formats'-添加文章形式支持,比如相册、图像、视频   
    //'post-thumbnails'-特色图像   
    //'custom-background'-自定义背景   
    //'custom-header'-自定义头部   
    //'automatic-feed-links'-文章和评论RSS feed链接   
/**
* 函数名称：post_thumbnail_url
* 函数作用：输出特殊图片中的图片链接地址
*/
function post_thumbnail_url(){
    global $post, $posts;
    if (has_post_thumbnail()) {
        $html = get_the_post_thumbnail();
        preg_match_all("/<img.*src\s*=\s*[\"|\']?\s*([^>\"\'\s]*)/i", $html, $matches);
        $imgsrc=$matches[1][0];
    }else{
        $content = $post->post_content;
        preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',$post->post_content,$matches);
        $imgsrc=$matches[1][0];
        if($imgsrc==""){ 
        // 如果无图片则显示none，当然也可以自定义个URL地址
            $imgsrc="none";
        }
    }
    echo "$imgsrc";
}

/* 
 * 只在前台隐藏工具条
 */  
if ( !is_admin() ) {  
    add_filter('show_admin_bar', '__return_false'); 
}

//添加上一篇下一篇
function previous_post_url(){
    global $post, $posts;
    $html = get_previous_post_link("%link");
    preg_match_all("/<a.*href\s*=\s*[\"|\']?\s*([^>\"\'\s]*)/i", $html, $matches);
    $previousurl=$matches[1][0];
    echo "$previousurl";
}
function next_post_url(){
    global $post, $posts;
    $html = get_next_post_link("%link");
    preg_match_all("/<a.*href\s*=\s*[\"|\']?\s*([^>\"\'\s]*)/i", $html, $matches);
    $nexturl=$matches[1][0];
    echo "$nexturl";
}
function previous_post_title(){
    global $post, $posts;
    if (get_previous_post()) {
        $html = get_previous_post_link("%link");
        $pattern = '/<a href="[^"]*"[^>]*>(.*)<\/a>/';
        preg_match_all($pattern, $html, $matches);
        $previoustitle=$matches[1][0];
    }else{
        $previoustitle="没有了，已经是最后的文章了";
        }
    
    echo "$previoustitle";
}
function next_post_title(){
    global $post, $posts;
    if (get_next_post()) {
        $html = get_next_post_link("%link");
        $pattern = '/<a href="[^"]*"[^>]*>(.*)<\/a>/';
        preg_match_all($pattern, $html, $matches);
        $nexttitle=$matches[1][0];
    }else{
        $nexttitle="没有了，已经是最新的文章了";
        }
    
    echo "$nexttitle";
}
//TinyMCE编辑器增强
function enable_more_buttons($buttons) {   
     $buttons[] = 'fontsizeselect';   
     $buttons[] = 'wp_page';   
     $buttons[] = 'anchor';   
     $buttons[] = 'backcolor';   
     return $buttons;   
     }   
add_filter("mce_buttons_2", "enable_more_buttons");  

//添加分页
function par_pagenavi($range = 9){
    global $paged, $wp_query;
    if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
    if($max_page > 1){if(!$paged){$paged = 1;}
    if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'> 返回首页 </a>";}
    previous_posts_link(' 上一页 ');
    if($max_page > $range){
        if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<a href='" . get_pagenum_link($i) ."'";
        if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    elseif($paged >= ($max_page - ceil(($range/2)))){
        for($i = $max_page - $range; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
        if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
        for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";}}}
    else{for($i = 1; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    next_posts_link(' 下一页 ');
    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'> 最后一页 </a>";}}
}

//注册侧边栏   
/** widgets */
if( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'name' => '默认侧边栏',
        'id'  => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>'
    ));
}
//评论表单开始
function aurelius_comment($comment, $args, $depth) 
{
   $GLOBALS['comment'] = $comment; ?>
   <li class="comment" id="li-comment-<?php comment_ID(); ?>">
        <div class="gravatar"> <?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 48); } ?>
 <?php comment_reply_link(array_merge( $args, array('reply_text' => '回复','depth' => $depth, 'max_depth' => $args['max_depth']))) ?> </div>
        <div class="comment_content" id="comment-<?php comment_ID(); ?>">   
            <div class="clearfix">
                    <?php printf(__('<cite class="author_name">%s</cite>'), get_comment_author_link()); ?>
                    <div class="comment-meta commentmetadata">发表于：<?php echo get_comment_time('Y-m-d H:i'); ?></div>
                       <?php edit_comment_link('修改'); ?>
            </div>

            <div class="comment_text">
                <?php if ($comment->comment_approved == '0') : ?>
                    <em>你的评论正在审核，稍后会显示出来！</em><br />
        <?php endif; ?>
        <?php comment_text(); ?>
            </div>
        </div>
<?php } ?>
<?php 
//评论表单结束
/* 获取文章的评论人数 by zwwooooo | zww.me */
function zfunc_comments_users($postid=0,$which=0) {
    $comments = get_comments('status=approve&type=comment&post_id='.$postid); //获取文章的所有评论
    if ($comments) {
        $i=0; $j=0; $commentusers=array();
        foreach ($comments as $comment) {
            ++$i;
            if ($i==1) { $commentusers[] = $comment->comment_author_email; ++$j; }
            if ( !in_array($comment->comment_author_email, $commentusers) ) {
                $commentusers[] = $comment->comment_author_email;
                ++$j;
            }
        }
        $output = array($j,$i);
        $which = ($which == 0) ? 0 : 1;
        return $output[$which]; //返回评论人数
    }
    return 0; //没有评论返回0
}
/* 访问计数 */
function record_visitors()
{
    if (is_singular())
    {
      global $post;
      $post_ID = $post->ID;
      if($post_ID)
      {
          $post_views = (int)get_post_meta($post_ID, 'views', true);
          if(!update_post_meta($post_ID, 'views', ($post_views+1)))
          {
            add_post_meta($post_ID, 'views', 1, true);
          }
      }
    }
}
add_action('wp_head', 'record_visitors');
 
/// 函数名称：post_views
/// 函数作用：取得文章的阅读次数
function post_views($before = '(点击 ', $after = ' 次)', $echo = 1)
{
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'views', true);
  if ($echo) echo $before, number_format($views), $after;
  else return $views;
}

?>