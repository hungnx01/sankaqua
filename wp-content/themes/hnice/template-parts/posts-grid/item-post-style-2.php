<div class="post-style-2">
    <div class="post-inner">
        <div class="post-content">
            <div class="entry-content">
                <div class="entry-meta">
                    <?php hnice_post_meta(['show_cat' => false, 'show_date' => true, 'show_author' => true, 'show_comment' => false]); ?>
                </div>
                <?php the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>

                <div class="excerpt-content"><?php echo wp_trim_words(get_the_excerpt(), 30); ?></div>

                <div class="more-link-wrap">
                    <a class="more-link" href="<?php the_permalink() ?>">
                        <span><?php echo esc_html__('Read More', 'hnice'); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
