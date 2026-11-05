<?php
/** Blog / posts page, archive and search results */
if (!defined('ABSPATH')) exit;
get_header();
global $wp_query;
$paged = max(1, (int) get_query_var('paged'));
if (is_search()) { $title = sprintf(__('Search: %s', 'fast-lights'), get_search_query()); }
elseif (is_archive()) { $title = get_the_archive_title(); }
else { $title = get_bloginfo('name') . ' ' . __('Blog', 'fast-lights'); }
$featured = null;
$list = [];
if (have_posts()) {
    while (have_posts()) { the_post(); $list[] = get_post(); }
    if ($paged === 1 && !is_search() && count($list) > 1) $featured = array_shift($list);
}
?>
<main>
<div class="page" id="p-blog">
<section class="bl-top" data-bs-theme="light"><div class="container"><div><span class="kick"><?php esc_html_e('Journal', 'fast-lights'); ?></span><h1><?php echo esc_html($title); ?></h1><p><?php esc_html_e('News, tips aur production insights.', 'fast-lights'); ?></p></div>
<form class="bsearch" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>"><input class="form-control" type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="<?php esc_attr_e('Search articles...', 'fast-lights'); ?>"><button class="btn btn--sm btn-primary btn-sm" type="submit"><?php esc_html_e('Search', 'fast-lights'); ?></button></form></div></section>
<section class="bl-body" data-bs-theme="light"><div class="container">
<?php if ($featured) : ?>
<article class="feat"><div class="fi <?php echo has_post_thumbnail($featured) ? '' : 'art-dusk'; ?>"<?php if (has_post_thumbnail($featured)) echo ' style="background-image:url(' . esc_url(get_the_post_thumbnail_url($featured, 'large')) . ')"'; ?>></div><div class="fb"><div class="meta" style="font-size:13px;letter-spacing:.12em;text-transform:uppercase;font-weight:600;margin-bottom:10px"><?php esc_html_e('Featured', 'fast-lights'); ?><?php $c = get_the_category($featured->ID); if ($c) echo ' &bull; ' . esc_html($c[0]->name); ?></div><h2><?php echo esc_html(get_the_title($featured)); ?></h2><p><?php echo esc_html(wp_trim_words(get_the_excerpt($featured), 28)); ?></p><a class="btn btn-primary" href="<?php echo esc_url(get_permalink($featured)); ?>"><?php esc_html_e('Read Article', 'fast-lights'); ?> <?php echo fl_icon('arrow', 18); ?></a></div></article>
<?php endif; ?>
<div class="row g-4"><div class="col-12 col-lg-8"><div class="bposts">
<?php if ($list) : foreach ($list as $i => $p) : $cats = get_the_category($p->ID); ?>
<article class="bpost"><a class="bi <?php echo has_post_thumbnail($p) ? '' : esc_attr(fl_art_class($i)); ?>" href="<?php echo esc_url(get_permalink($p)); ?>"<?php if (has_post_thumbnail($p)) echo ' style="background-image:url(' . esc_url(get_the_post_thumbnail_url($p, 'medium_large')) . ')"'; ?>></a><div class="bb"><div class="meta" style="font-size:12.5px;letter-spacing:.12em;text-transform:uppercase;font-weight:600;margin-bottom:6px"><?php echo $cats ? esc_html($cats[0]->name) . ' &bull; ' : ''; ?><?php echo esc_html(get_the_date('M Y', $p)); ?></div><h3><a href="<?php echo esc_url(get_permalink($p)); ?>"><?php echo esc_html(get_the_title($p)); ?></a></h3><p><?php echo esc_html(wp_trim_words(get_the_excerpt($p), 22)); ?></p><a class="more" href="<?php echo esc_url(get_permalink($p)); ?>"><?php esc_html_e('Read more', 'fast-lights'); ?> <?php echo fl_icon('arrow', 18); ?></a></div></article>
<?php endforeach; elseif (!$featured) : ?>
<p><?php esc_html_e('No articles found.', 'fast-lights'); ?></p>
<?php endif; ?>
<?php $links = paginate_links(['type' => 'array', 'prev_text' => '&larr;', 'next_text' => '&rarr;']); if ($links) : ?>
<div class="pager"><?php echo wp_kses_post(implode('', $links)); ?></div>
<?php endif; ?>
</div></div>
<div class="col-12 col-lg-4"><?php get_template_part('sidebar-blog'); ?></div></div>
</div></section>
</div>
</main>
<?php get_footer();
