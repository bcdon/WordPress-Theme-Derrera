  <?php get_header(); ?>
    <div class="barba-container menu-active mt3" data-namespace="post">
      <div class="content">
        <div class="ph4 ph5-l">
          <header class="min-vh-50-l lh-solid w-100 mt2 mb5 pt4
            flex flex-column items-baseline justify-between">
            <h1 class="f2 f1-m f-5-l mt2 mb0 mw7 lh-title lh-solid-l"><?php the_title(); ?></h1>
            <span class="f7 ttu tracked-mega mono silver mb5"><?php the_time('Y年n月j日') ?></span>
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
                  <div class="errorbox">
                    没有文章！
                  </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="bt bb b--light-gray flex content-stretch justify-end mt6">
              <a class="hover-bg-near-white no-underline 
              flex items-center w-50 pv3 pv4-ns ph4 ph5-l" href="<?php previous_post_url(); ?>">
                <?php 
                if (get_previous_post()) {
                  echo '<img src="'.get_bloginfo('template_url').'/img/icon-arrow.svg" alt="">';
                  }else{
                  echo "";
                  }
               ?>
                <span class="pl3 dn db-l">
                  <?php previous_post_title(); ?>
                </span>
              </a>
              <a class="hover-bg-near-white no-underline 
              flex items-center justify-end w-50 tr pv3 pv4-ns ph4 ph5-l bl b--light-gray" href="<?php next_post_url(); ?>">
                <span class="pr3 dn db-l">
                  <?php next_post_title(); ?>
                </span>
                <?php 
                if (get_next_post()) {
                  echo '<img class="rotate-180" src="'.get_bloginfo('template_url').'/img/icon-arrow.svg" alt="">';
                  }else{
                  echo "";
                  }
                 ?>
              </a>
        </div>
      </div>
      <?php get_sidebar(); ?>
      <div class="clear"></div>
    <?php get_footer(); ?>