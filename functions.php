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
        $previoustitle="没有了，已经是最新的文章了";
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
        $nexttitle="没有了，已经是最后的文章了";
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


?>