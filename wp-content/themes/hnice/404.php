<?php
get_header(); ?>
    <div id="primary" class="content">
        <main id="main" class="site-main">
            <div class="error-404 not-found" style="background-image:url(<?php echo get_theme_file_uri('assets/images/404/404-bg.png') ?>)">
                <div class="page-content">
                    <div class="page-header">
                        <div class="img-404">
                            <img src="<?php echo get_theme_file_uri('assets/images/404/404.png') ?>" alt="<?php echo esc_attr__('404 Page not found', 'hnice') ?>">
                        </div>
                        <h2 class="error-subtitle"><?php esc_html_e('Oops! page not found', 'hnice'); ?></h2>
                        </header><!-- .page-header -->
                        <div class="error-text">
                            <span><?php esc_html_e('Page does not exist or some other error occured. Go to our Home Page', 'hnice') ?></span>
                        </div>
                        <div class="error-button">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="go-back"><?php esc_html_e('Back to Homepage', 'hnice'); ?>
                                <i class="hnice-icon-right-arrow"></i>
                            </a>

                        </div>
                    </div><!-- .page-content -->
                </div><!-- .error-404 -->
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();



