<?php
if (!defined('ABSPATH')) exit;

add_action('customize_register', function ($wp) {
    $wp->add_section('fl_contact', [
        'title'       => __('Fast Lights Contact', 'fast-lights'),
        'priority'    => 30,
        'description' => __('Phone, email, address and hours shown in the header, footer, home and contact pages.', 'fast-lights'),
    ]);
    $fields = [
        'phone'   => ['Phone', 'text'],
        'email'   => ['Email (also receives form messages)', 'text'],
        'address' => ['Address', 'text'],
        'hours'   => ['Opening hours', 'text'],
        'city'    => ['City (top bar)', 'text'],
    ];
    $d = fl_defaults();
    foreach ($fields as $key => $f) {
        $wp->add_setting('fl_' . $key, [
            'default'           => $d[$key],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ]);
        $wp->add_control('fl_' . $key, [
            'label'   => __($f[0], 'fast-lights'),
            'section' => 'fl_contact',
            'type'    => $f[1],
        ]);
    }
});
