<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to hnice_page action
	 *
	 * @see hnice_page_header          - 10
	 * @see hnice_page_content         - 20
	 *
	 */
	do_action( 'hnice_page' );
	?>
</article><!-- #post-## -->
