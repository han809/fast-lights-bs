<?php
if (!defined('ABSPATH')) exit;

/** Bootstrap 5 navbar walker (flat, 1 level). */
class FL_Nav_Walker extends Walker_Nav_Menu {
    public function start_lvl(&$output, $depth = 0, $args = null) {}
    public function end_lvl(&$output, $depth = 0, $args = null) {}
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        if ($depth > 0) return;
        $c = (array) $item->classes;
        $active = in_array('current-menu-item', $c, true) || in_array('current_page_item', $c, true)
            || in_array('current-menu-ancestor', $c, true) || in_array('current-page-ancestor', $c, true)
            || in_array('current_page_parent', $c, true);
        $cls = 'nav-link' . ($active ? ' on active' : '');
        $output .= '<li class="nav-item"><a class="' . esc_attr($cls) . '" href="' . esc_url($item->url) . '"' . ($active ? ' aria-current="page"' : '') . '>' . esc_html($item->title) . '</a>';
    }
    public function end_el(&$output, $item, $depth = 0, $args = null) {
        if ($depth > 0) return;
        $output .= '</li>';
    }
}

/** Fallback when no menu is assigned. */
function fl_fallback_menu() {
    $items = ['' => 'Home', 'about' => 'About Us', 'services' => 'Services', 'gallery' => 'Gallery', 'blog' => 'Blog', 'contact' => 'Contact Us'];
    echo '<ul class="navbar-nav menu">';
    foreach ($items as $slug => $label) {
        $url = $slug === '' ? home_url('/') : fl_url($slug);
        echo '<li class="nav-item"><a class="nav-link" href="' . esc_url($url) . '">' . esc_html($label) . '</a></li>';
    }
    echo '</ul>';
}
