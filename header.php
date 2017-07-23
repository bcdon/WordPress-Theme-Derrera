<?php global $set_inlobase; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title><?php if ( is_home() ) {
		bloginfo('name'); echo $set_inlobase['seo-titlefenge']; bloginfo('description');
	} elseif ( is_category() ) {
		single_cat_title(); echo $set_inlobase['seo-titlefenge']; bloginfo('name');
	} elseif (is_single() || is_page() ) {
		single_post_title();
	} elseif (is_search() ) {
		echo "搜索结果"; echo $set_inlobase['seo-titlefenge']; bloginfo('name');
	} elseif (is_404() ) {
		echo '页面未找到!';
	} else {
		wp_title('',true);
	} ?></title>
  <?php
	$description = '';
	$keywords = '';
	 
	if (is_home() || is_page()) {
	   $description = $set_inlobase['seo-description'];
	   $keywords = $set_inlobase['seo-keywords'];
	}
	elseif (is_single()) {
	   $description1 = get_post_meta($post->ID, "description", true);
	   $description2 = str_replace("\n","",mb_strimwidth(strip_tags($post->post_content), 0, 200, "…", 'utf-8'));
	   $description = $description1 ? $description1 : $description2;
	   $keywords = get_post_meta($post->ID, "keywords", true);
	   if($keywords == '') {
	      $tags = wp_get_post_tags($post->ID);    
	      foreach ($tags as $tag ) {        
	         $keywords = $keywords . $tag->name . ", ";    
	      }
	      $keywords = rtrim($keywords, ', ');
	   }
	}
	elseif (is_category()) {
	   $description = category_description();
	   $keywords = single_cat_title('', false);
	}
	elseif (is_tag()){
	   $description = tag_description();
	   $keywords = single_tag_title('', false);
	}
	$description = trim(strip_tags($description));
	$keywords = trim(strip_tags($keywords));
	?>
  <meta name="description" content="<?php echo $description; ?>" />
  <meta name="keywords" content="<?php echo $keywords; ?>" />
  <link rel="shortcut icon" href="<?php echo $set_inlobase['general-Favicon']['url'];?>">
  <link rel="apple-touch-icon" href="<?php echo $set_inlobase['general-apple-touch']['url'];?>">
  <link rel="icon" href="<?php echo $set_inlobase['general-apple-touch']['url'];?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/main.css" />
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css"/>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有文章" href="<?php echo get_bloginfo('rss2_url'); ?>" />
  <link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有评论" href="<?php bloginfo('comments_rss2_url'); ?>" />       
  <?php wp_head(); ?>
</head>

<?php flush(); ?>

<body class="overflow-x-hidden">
  <div class="header menu-active bg-white
    h3 vh-100-l
    br-l b--light-gray
    fixed-l top-0 left-0 z-max
    flex justify-between flex-row-reverse flex-row-l items-center items-start-l">
    <div class="ph4 pv0-l w-100 w-auto-l flex flex-column-l justify-between items-center">
      <div class="vh-50-l flex items-end">
        <a href="<?php echo get_option('home'); ?>/" class="no-underline">
          <?php 
          if ($set_inlobase['header-logoswitch']==2) {
            echo '<img src="'.$set_inlobase['header-logoswitch-logoimg']['url'].'" alt="">';
            }else{
            echo '<h1 class="f4 f3-l ma0">'.get_bloginfo(’name’).'</h1>';
            }
         ?>
        </a>
      </div>
      <div class="fixed-l bottom-0 left-0 inline-flex justify-center items-center ma4-l">
        <a href="<?php echo get_option('home'); ?>/about" class="o-50 glow">
          <img src="<?php bloginfo('template_url'); ?>/img/icon-about.svg" alt="">
        </a>
      </div>
    </div>
    <div class="menu open">
      <a href="<?php echo get_option('home'); ?>/" class="vh-100 vh-50-l flex items-center items-end-l justify-center">
        <img src="<?php bloginfo('template_url'); ?>/img/icon-menu.svg" class="mb1" alt="">
      </a>
    </div>
  </div>
<div id="barba-wrapper">