<div class="sidebar"> 
   <?php if ( !function_exists('dynamic_sidebar')    
                       || !dynamic_sidebar('sidebar-1') ) : ?>  
       <aside id="search-5" class="widget widget_search">
       <h4 class="widget-title">搜索</h4> 
       <?php get_search_form(); ?>
       </aside>
       <aside id="categories-4" class="widget widget_categories"> 
       <h4 class="widget-title">分类目录</h4>   
       <ul>   
           <?php wp_list_categories('depth=1&title_li=&orderby=id&show_count=0&hide_empty=1&child_of=0'); ?>   
       </ul>
       </aside>
       <aside id="recent-posts-5" class="widget widget_recent_entries">
       <h4 class="widget-title">最新文章</h4>   
       <ul>   
           <?php   
               $posts = get_posts('numberposts=6&orderby=post_date');   
               foreach($posts as $post) {   
                   setup_postdata($post);   
                   echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';   
               }   
               $post = $posts[0];   
           ?>   
       </ul> 
       </aside> 
       <aside id="tag_cloud-3" class="widget widget_tag_cloud">  
       <h4 class="widget-title">标签云</h4>   
       <p><?php wp_tag_cloud('smallest=8&largest=22'); ?></p> 
       </aside> 
       <aside id="archives-4" class="widget widget_archive"> 
   	   <h4 class="widget-title">文章存档</h4>   
       <ul>   
           <?php wp_get_archives('limit=10'); ?>   
       </ul>  
       </aside>    
   <?php endif; ?>  
</div>