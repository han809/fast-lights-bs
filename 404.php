<?php
if (!defined('ABSPATH')) exit;
get_header(); ?>
<main><div class="page" id="p-404"><section class="error-404"><div class="container"><h1>404</h1><h2><?php esc_html_e('Page not found', 'fast-lights'); ?></h2><p class="mb-4"><?php esc_html_e('Yeh page maujood nahi hai ya hata diya gaya hai.', 'fast-lights'); ?></p><a class="btn btn-primary" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Back to Home', 'fast-lights'); ?></a></div></section></div></main>
<?php get_footer();
