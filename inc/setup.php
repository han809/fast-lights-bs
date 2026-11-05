<?php
if (!defined('ABSPATH')) exit;

/**
 * On activation: create the 6 pages, assign templates, set front/posts page,
 * build + assign the primary menu and add a few sample blog posts.
 * Every step is guarded, so existing content is never overwritten.
 */
add_action('after_switch_theme', 'fl_activate');

function fl_find_page($paths) {
    foreach ((array) $paths as $p) {
        $page = get_page_by_path($p);
        if ($page) return $page->ID;
    }
    return 0;
}

function fl_ensure_page($title, $slugs, $template = '') {
    $id = fl_find_page($slugs);
    if (!$id) {
        $id = wp_insert_post([
            'post_title'   => $title,
            'post_name'    => $slugs[0],
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ]);
    }
    if ($id && !is_wp_error($id) && $template && !get_post_meta($id, '_wp_page_template', true)) {
        update_post_meta($id, '_wp_page_template', $template);
    }
    return (int) $id;
}

function fl_activate() {
    if (get_option('fl_bs_setup_done')) return;

    $home     = fl_ensure_page('Home', ['home']);
    $about    = fl_ensure_page('About Us', ['about', 'about-us'], 'page-about.php');
    $services = fl_ensure_page('Services', ['services'], 'page-services.php');
    $gallery  = fl_ensure_page('Gallery', ['gallery'], 'page-gallery.php');
    $blog     = fl_ensure_page('Blog', ['blog']);
    $contact  = fl_ensure_page('Contact Us', ['contact', 'contact-us'], 'page-contact.php');

    if ($home && $blog) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home);
        update_option('page_for_posts', $blog);
    }

    // Menu
    $locations = get_theme_mod('nav_menu_locations');
    if (empty($locations['primary'])) {
        $menu = wp_get_nav_menu_object('Fast Lights Primary');
        $menu_id = $menu ? $menu->term_id : wp_create_nav_menu('Fast Lights Primary');
        if ($menu_id && !is_wp_error($menu_id) && !wp_get_nav_menu_items($menu_id)) {
            foreach ([$home, $about, $services, $gallery, $blog, $contact] as $pid) {
                if (!$pid) continue;
                wp_update_nav_menu_item($menu_id, 0, [
                    'menu-item-object-id' => $pid,
                    'menu-item-object'    => 'page',
                    'menu-item-type'      => 'post_type',
                    'menu-item-status'    => 'publish',
                ]);
            }
        }
        if ($menu_id && !is_wp_error($menu_id)) {
            if (!is_array($locations)) $locations = [];
            $locations['primary'] = $menu_id;
            set_theme_mod('nav_menu_locations', $locations);
        }
    }

    fl_seed_posts();
    update_option('fl_bs_setup_done', 1);
    flush_rewrite_rules();
}

function fl_seed_posts() {
    if (get_option('fl_bs_seeded')) return;
    $counts = wp_count_posts('post');
    if ((int) $counts->publish > 1) { update_option('fl_bs_seeded', 1); return; }
    $posts = [
        ['A Simple Checklist For Your Next Film Shoot', 'Tips', 'Shoot se pehle gear, crew, power aur logistics, in sab cheezon ko ek jagah check karne ka asaan tareeqa.'],
        ['How to Plan Your Grip & Lighting Package', 'Gear', 'Shoot se pehle sahi gear list banane ke asaan tareeqe.'],
        ['What a Gaffer and Key Grip Actually Do', 'Crew', 'Set par in dono roles ka farq aur kab kis ki zaroorat.'],
        ['Choosing the Right Studio Space', 'Studio', 'Studio book karne se pehle ye cheezein check karein.'],
        ['5 Ways to Keep Your Shoot on Schedule', 'Tips', 'Chhoti planning, bara farq.'],
        ['LED vs Tungsten: Which Should You Rent?', 'Gear', 'Dono ke fayde aur kab kya chunna.'],
    ];
    $i = 0;
    foreach (array_reverse($posts) as $p) {
        $term = term_exists($p[1], 'category');
        if (!$term) $term = wp_insert_term($p[1], 'category');
        $cat = is_array($term) ? (int) $term['term_id'] : (int) $term;
        wp_insert_post([
            'post_title'    => $p[0],
            'post_excerpt'  => $p[2],
            'post_content'  => '<p>' . $p[2] . '</p><p>Yeh ek sample article hai. Ise Posts &rarr; Edit mein ja kar apne content se badal dein.</p><h2>Key points</h2><ul><li>Pehle apni zaroorat likhein</li><li>Dates aur location confirm karein</li><li>Gear aur crew ek saath book karein</li></ul>',
            'post_status'   => 'publish',
            'post_category' => [$cat],
            'post_date'     => gmdate('Y-m-d H:i:s', time() - (++$i) * 3600),
        ]);
    }
    update_option('fl_bs_seeded', 1);
}
