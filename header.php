<?php
if (!defined('ABSPATH')) exit;
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="topbar"><div class="container"><ul><li><?php echo fl_icon('phone', 15); ?><a href="tel:<?php echo esc_attr(fl_tel()); ?>"><?php echo esc_html(fl_opt('phone')); ?></a></li><li><?php echo fl_icon('mail', 15); ?><a href="mailto:<?php echo esc_attr(fl_opt('email')); ?>"><?php echo esc_html(fl_opt('email')); ?></a></li></ul><ul class="hide-s"><li><?php echo fl_icon('clock', 15); ?><?php echo esc_html(fl_opt('hours')); ?></li><li><?php echo fl_icon('pin', 15); ?><?php echo esc_html(fl_opt('city')); ?></li></ul></div></div>
<header class="hdr" data-bs-theme="dark"><nav class="navbar navbar-expand-xl" aria-label="<?php esc_attr_e('Main navigation', 'fast-lights'); ?>"><div class="container">
<a class="navbar-brand logo" href="<?php echo esc_url(home_url('/')); ?>"><?php if (has_custom_logo()) { the_custom_logo(); } else { ?><i><?php echo fl_icon('bolt', 22); ?></i><?php bloginfo('name'); } ?></a>
<button class="navbar-toggler hdr-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'fast-lights'); ?>"><span class="navbar-toggler-icon"></span></button>
<div class="collapse navbar-collapse hdr-nav" id="nav">
<?php wp_nav_menu([
    'theme_location' => 'primary',
    'container'      => false,
    'menu_class'     => 'navbar-nav menu',
    'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
    'walker'         => new FL_Nav_Walker(),
    'fallback_cb'    => 'fl_fallback_menu',
]); ?>
<a class="btn btn-primary btn-sm btn--sm" href="<?php echo esc_url(fl_url('contact')); ?>"><?php esc_html_e('Get a Quote', 'fast-lights'); ?></a>
</div></div></nav></header>
<?php if (isset($_GET['fl_sent'])) : ?>
<div class="fl-notice"><div class="alert alert-<?php echo $_GET['fl_sent'] === '1' ? 'success' : 'danger'; ?>" role="alert"><?php echo $_GET['fl_sent'] === '1' ? esc_html__('Thank you! Your request was sent. We will reply shortly.', 'fast-lights') : esc_html__('Sorry, the message could not be sent. Please call us or try again.', 'fast-lights'); ?></div></div>
<?php endif; ?>
