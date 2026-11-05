<?php
/**
 * Fast Lights (Bootstrap) - functions
 */
if (!defined('ABSPATH')) exit;

define('FL_VER', '1.0.0');

require_once get_template_directory() . '/inc/helpers.php';
require_once get_template_directory() . '/inc/nav-walker.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/forms.php';
require_once get_template_directory() . '/inc/setup.php';

add_action('after_setup_theme', function () {
    load_theme_textdomain('fast-lights', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('responsive-embeds');
    register_nav_menus([
        'primary' => __('Primary Menu', 'fast-lights'),
        'footer'  => __('Footer Menu', 'fast-lights'),
    ]);
});

add_action('wp_enqueue_scripts', function () {
    $uri = get_template_directory_uri();
    wp_enqueue_style('fl-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Oswald:wght@500;600;700&display=swap', [], null);
    wp_enqueue_style('fl-bootstrap', $uri . '/assets/vendor/bootstrap.min.css', [], '5.3.3');
    wp_enqueue_style('fl-theme', $uri . '/assets/css/theme.css', ['fl-bootstrap'], FL_VER);
    wp_enqueue_style('fl-art', $uri . '/assets/css/art.css', ['fl-theme'], FL_VER);
    wp_enqueue_script('fl-bootstrap', $uri . '/assets/vendor/bootstrap.bundle.min.js', [], '5.3.3', true);
    wp_enqueue_script('fl-theme', $uri . '/assets/js/theme.js', ['fl-bootstrap'], FL_VER, true);
});

// Bootstrap dark theme on <html>
add_filter('language_attributes', function ($out) {
    return $out . ' data-bs-theme="dark"';
});
