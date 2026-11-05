<?php
if (!defined('ABSPATH')) exit;
get_header();
while (have_posts()) : the_post(); $cats = get_the_category(); ?>
<main>
<div class="page" id="p-single">
<section class="bl-top" data-bs-theme="light"><div class="container"><div><span class="kick"><?php echo $cats ? esc_html($cats[0]->name) : esc_html__('Journal', 'fast-lights'); ?></span><h1><?php the_title(); ?></h1><p class="single-meta"><?php echo esc_html(get_the_date()); ?> &bull; <?php the_author(); ?></p></div></div></section>
<section class="bl-body" data-bs-theme="light"><div class="container"><div class="row g-4">
<div class="col-12 col-lg-8"><article class="single-card entry-content">
<?php if (has_post_thumbnail()) : ?><div class="post-thumb" style="background-image:url(<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>)"></div><?php endif; ?>
<?php the_content(); ?>
<?php wp_link_pages(); ?>
<p><a class="more" href="<?php echo esc_url(fl_url('blog')); ?>">&larr; <?php esc_html_e('Back to blog', 'fast-lights'); ?></a></p>
</article></div>
<div class="col-12 col-lg-4"><?php get_template_part('sidebar-blog'); ?></div>
</div></div></section>
</div>
</main>
<?php endwhile; get_footer();
