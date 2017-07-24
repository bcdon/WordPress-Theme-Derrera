<?php
/*
Template Name: about me
*/
?>
  <?php get_header(); ?>
 
    <div class="barba-container menu-active mt3" data-namespace="about">
  
  <div class="pt5 ph4 ph5-l vh-50-l flex items-end">
    <img class="br-100 w4 h4 w5-l h5-l" src="<?php post_thumbnail_url(); ?>" alt="">
  </div>
  
  <div class="pa4 pa5-l">
  <div class="
      nested-copy-seperator
      nested-copy-line-height
      nested-headline-line-height
      nested-margin-first">
      <div class="measure">
  <?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
    <?php the_content(); ?>
    <?php else : ?>
	<div class="grid_8">
		没有找到你想要的页面！
	</div>
	<?php endif; ?>
	</div>
    </div>
  </div>
  <?php get_footer(); ?>