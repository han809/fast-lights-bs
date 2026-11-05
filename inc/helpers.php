<?php
if (!defined('ABSPATH')) exit;

/** Default contact details (editable in Appearance > Customize > Fast Lights Contact). */
function fl_defaults() {
    return [
        'phone'   => '+92 326 2699626',
        'email'   => 'hamzajaved.sahil@gmail.com',
        'address' => '123 Studio Way, Boston, MA',
        'hours'   => 'Mon - Fri: 8:00 AM - 6:00 PM',
        'city'    => 'Boston, MA',
    ];
}

function fl_opt($key) {
    $d = fl_defaults();
    $v = get_theme_mod('fl_' . $key, isset($d[$key]) ? $d[$key] : '');
    return $v !== '' ? $v : (isset($d[$key]) ? $d[$key] : '');
}

/** Digits only, for tel: links. */
function fl_tel() {
    return preg_replace('/[^0-9+]/', '', fl_opt('phone'));
}

/** Permalink of a main page by slug (with fallbacks). */
function fl_url($slug) {
    static $cache = [];
    if (isset($cache[$slug])) return $cache[$slug];
    $alias = [
        'about'    => ['about', 'about-us'],
        'services' => ['services'],
        'gallery'  => ['gallery'],
        'contact'  => ['contact', 'contact-us'],
        'blog'     => ['blog'],
    ];
    $url = '';
    if ($slug === 'blog') {
        $pid = (int) get_option('page_for_posts');
        if ($pid) $url = get_permalink($pid);
    }
    if (!$url && isset($alias[$slug])) {
        foreach ($alias[$slug] as $path) {
            $p = get_page_by_path($path);
            if ($p) { $url = get_permalink($p); break; }
        }
    }
    if (!$url) $url = home_url('/' . $slug . '/');
    return $cache[$slug] = $url;
}

/** Art class cycle for posts without a featured image. */
function fl_art_class($i) {
    $a = ['art-t1', 'art-t2', 'art-t4', 'art-t6', 'art-t8', 'art-t10', 'art-t3', 'art-t5'];
    return $a[$i % count($a)];
}

/** Inline SVG icon (same icon set as the design). */
function fl_icon($name, $size = 20) {
    $icons = [
        'phone' => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z"/>',
        'mail'  => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
        'pin'   => '<path d="M12 21s7-6.2 7-11a7 7 0 1 0-14 0c0 4.8 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/>',
        'clock' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
        'bolt'  => '<path d="M13 3 5 14h6l-1 7 8-11h-6z"/>',
        'arrow' => '<path d="M5 12h14M13 6l6 6-6 6"/>',
    ];
    $p = isset($icons[$name]) ? $icons[$name] : '';
    return '<svg class="ico" viewBox="0 0 24 24" width="' . (int) $size . '" height="' . (int) $size . '" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $p . '</svg>';
}
