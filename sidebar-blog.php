<?php if (!defined('ABSPATH')) exit; ?>
<aside>
<div class="widget"><h4><?php esc_html_e('Categories', 'fast-lights'); ?></h4><ul>
<?php foreach (get_categories(['hide_empty' => true]) as $c) : ?>
<li><a href="<?php echo esc_url(get_category_link($c)); ?>"><?php echo esc_html($c->name); ?> <b><?php echo (int) $c->count; ?></b></a></li>
<?php endforeach; ?>
</ul></div>
<div class="widget"><h4><?php esc_html_e('Recent Posts', 'fast-lights'); ?></h4><ul>
<?php foreach (get_posts(['numberposts' => 5]) as $rp) : ?>
<li><a href="<?php echo esc_url(get_permalink($rp)); ?>"><?php echo esc_html(get_the_title($rp)); ?></a></li>
<?php endforeach; ?>
</ul></div>
<div class="widget nl"><h4><?php esc_html_e('Get Updates', 'fast-lights'); ?></h4><p><?php esc_html_e('Naye articles seedha inbox me.', 'fast-lights'); ?></p>
<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>"><div class="d-none"><input type="hidden" name="action" value="fl_contact"><?php wp_nonce_field('fl_contact', 'fl_nonce'); ?><input type="text" name="fl_website" value="" tabindex="-1" autocomplete="off"><input type="hidden" name="subject" value="Newsletter signup"></div><input class="form-control" type="email" name="email" placeholder="<?php esc_attr_e('Your email', 'fast-lights'); ?>" required><button class="btn btn-primary" type="submit"><?php esc_html_e('Subscribe', 'fast-lights'); ?></button></form></div>
</aside>
