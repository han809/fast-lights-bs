<?php
if (!defined('ABSPATH')) exit;

/** Handles every quote / contact form on the site (admin-post.php). */
add_action('admin_post_nopriv_fl_contact', 'fl_handle_contact');
add_action('admin_post_fl_contact', 'fl_handle_contact');

function fl_handle_contact() {
    $back = wp_get_referer();
    if (!$back) $back = home_url('/');
    $back = remove_query_arg('fl_sent', $back);

    if (empty($_POST['fl_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['fl_nonce'])), 'fl_contact')) {
        wp_die(esc_html__('Security check failed. Please go back and try again.', 'fast-lights'), '', ['response' => 403]);
    }
    // Honeypot: bots fill this hidden field.
    if (!empty($_POST['fl_website'])) {
        wp_safe_redirect($back);
        exit;
    }

    $skip = ['action', 'fl_nonce', '_wp_http_referer', 'fl_website'];
    $lines = [];
    $reply = '';
    foreach ($_POST as $key => $val) {
        if (in_array($key, $skip, true) || is_array($val)) continue;
        $key = sanitize_key($key);
        $val = sanitize_textarea_field(wp_unslash($val));
        if ($val === '') continue;
        if ($key === 'email' || $key === 'your_email') $reply = sanitize_email($val);
        $lines[] = ucwords(str_replace('_', ' ', $key)) . ': ' . $val;
    }

    $to = fl_opt('email');
    if (!is_email($to)) $to = get_option('admin_email');
    $headers = ['Content-Type: text/plain; charset=UTF-8'];
    if ($reply && is_email($reply)) $headers[] = 'Reply-To: ' . $reply;

    $subject = sprintf('[%s] New quote request', wp_specialchars_decode(get_bloginfo('name'), ENT_QUOTES));
    $ok = !empty($lines) && wp_mail($to, $subject, implode("\n", $lines), $headers);

    wp_safe_redirect(add_query_arg('fl_sent', $ok ? '1' : '0', $back));
    exit;
}
