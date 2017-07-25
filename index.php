  <?php get_header(); ?>
    <div class="barba-container mt3" data-namespace="home">
        <div class="toc">
            <div class="toc-container">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <a class="pv3 ph4 ph5-l flex items-baseline no-underline" href="<?php the_permalink(); ?>">
                  <span class="f7 mr4 mono tracked silver"><?php the_time('j n月 Y') ?></span> 
                  <span class="title dib b"><?php the_title(); ?></span>
                </a>
                <?php endwhile; ?>
                <?php else : ?>
                  当前没有文章！
                <?php endif; ?>
                <div class="page_navi"><?php par_pagenavi(9); ?></div>
            </div>
            <?php get_sidebar(); ?>
            <div class="clear"></div>
    <?php get_footer(); ?>