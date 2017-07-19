  <?php get_header(); ?>
  
    <div class="barba-container mt3" data-namespace="home">
  <div class="toc">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <a class="pv3 ph4 ph5-l flex items-baseline no-underline" href="<?php the_permalink(); ?>">
        <span class="f7 mr4 mono tracked silver"><?php the_time('Y年n月j日') ?></span> 
        <span class="title dib b"><?php the_title(); ?></span>
      </a>
      <?php endwhile; ?>
      <?php else : ?>
        当前没有文章！
      <?php endif; ?>
  </div>
  <?php get_footer(); ?>