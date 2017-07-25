<?php
	if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
	<div id="respond" class="comments-respond">
	<h3><?php echo zfunc_comments_users($post->ID); ?>&nbsp;人评论</h3>
	<ol class="commentlist">
		<?php 
    if (!empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) { 
        // if there's a password
        // and it doesn't match the cookie
    ?>
    <li class="decmt-box">
        <p><a href="#addcomment">请输入密码再查看评论内容.</a></p>
    </li>
    <?php 
        } else if ( !comments_open() ) {
    ?>
    <li class="decmt-box">
        <p><a href="#addcomment">评论功能已经关闭!</a></p>
    </li>
    <?php 
        } else if ( !have_comments() ) { 
    ?>
    <li class="decmt-box">
        <p><a href="#addcomment">还没有任何评论，你来说两句吧</a></p>
    </li>
    <?php 
        } else {
            wp_list_comments('type=comment&callback=aurelius_comment');
        }
    ?>
	</ol>
	<div class="hr clearfix"> </div>
<?php 
if ( !comments_open() ) :
// If registration required and not logged in.
elseif ( get_option('comment_registration') && !is_user_logged_in() ) : 
?>
<p>你必须 <a href="<?php echo wp_login_url( get_permalink() ); ?>">登录</a> 才能发表评论.</p>
<?php else  : ?>
<!-- Comment Form -->
<form id="commentform" name="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
    <h3 class="submitcomment">发表评论</h3>
        <?php if ( !is_user_logged_in() ) : ?>
        	<p class="comment-form-comment">
            <textarea id="comment" name="comment" tabindex="4" rows="8" cols="45"></textarea>
            </p>
            <p class="comment-form-author">
            <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="23" tabindex="1" />
            <label for="name">昵称*</label>
            </p>
            <p class="comment-form-email">
            <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="23" tabindex="2" />
            <label for="email">电子邮件*</label>
            </p>
            <p class="comment-form-url">
            <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="23" tabindex="3" />
            <label for="email">网址(选填)</label>
            </p>
        <?php else : ?>
        	<p class="logged-in-as"><a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php">已登录为<?php echo $user_identity; ?></a>。 <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="退出登录">登出？</a></p>
        	<p class="comment-form-comment">
        	<textarea id="comment" name="comment" tabindex="4" rows="8" cols="45"></textarea>
        	</p>
        <?php endif; ?>
            <!-- Add Comment Button -->
            <p class="form-submit">
            <input name="submit" type="submit" id="submit" class="submit" value="发表评论">
            </p>
    <?php comment_id_fields(); ?>
    <?php do_action('comment_form', $post->ID); ?>
</form>
<?php endif; ?>
</div>