  <?php get_header(); ?>

    <div class="barba-container menu-active mt3" data-namespace="post">
  
  <div class="ph4 ph5-l">
    
    <header class="min-vh-50-l lh-solid w-100 mt2 mb5 pt4
      flex flex-column items-baseline justify-between">
      <span class="f7 ttu tracked-mega mono silver mb5"><?php the_time('Y年n月j日') ?></span>
      <h1 class="f2 f1-m f-5-l mt2 mb0 mw7 lh-title lh-solid-l"><?php the_title(); ?></h1>
    </header>
    
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