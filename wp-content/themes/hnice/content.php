<article id="post-<?php the_ID(); ?>" <?php post_class('article-default'); ?>>
    <div class="post-inner">
        <?php hnice_post_thumbnail('post-thumbnail', false); ?>
        <div class="post-content">
            <?php
            /**
             * Functions hooked in to hnice_loop_post action.
             *
             * @see hnice_post_header          - 15
             * @see hnice_post_content         - 30
             */
            do_action('hnice_loop_post');
            ?>
        </div>
    </div>
</article><!-- #post-## -->