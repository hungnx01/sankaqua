<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="single-content">
        <?php
        /**
         * Functions hooked in to hnice_single_post_top action
         *
         */
        do_action('hnice_single_post_top');

        /**
         * Functions hooked in to hnice_single_post action
         * @see hnice_post_thumbnail - 10
         * @see hnice_post_header         - 20
         * @see hnice_post_content         - 30
         */
        do_action('hnice_single_post');

        /**
         * Functions hooked in to hnice_single_post_bottom action
         *
         * @see hnice_post_taxonomy      - 5
         * @see hnice_post_nav            - 10
         * @see hnice_display_comments    - 20
         */
        do_action('hnice_single_post_bottom');
        ?>

    </div>

</article><!-- #post-## -->
