<?php
if (!defined('ABSPATH')) exit;
get_header();
while (have_posts()) : the_post(); ?>
<main>
<div class="page" id="p-page">
<section class="bl-top" data-bs-theme="light"><div class="container"><div><span class="kick"><?php bloginfo('name'); ?></span><h1><?php the_title(); ?></h1></div></div></section>
<section class="bl-body" data-bs-theme="light"><div class="container"><article class="single-card entry-content"><?php the_content(); ?></article></div></section>
</div>
</main>
<?php endwhile; get_footer();
