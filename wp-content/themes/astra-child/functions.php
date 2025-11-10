<?php
function astra_child_enqueue_styles() {
    wp_enqueue_style(
        'astra-parent-style',
        get_template_directory_uri() . '/style.css'
    );

    wp_enqueue_style(
        'astra-child-style',
        get_stylesheet_uri(),
        ['astra-parent-style']
    );
}
add_action('wp_enqueue_scripts', 'astra_child_enqueue_styles');

function astra_child_enqueue_scripts() {
    if ( is_page('home-page') ) {
        wp_enqueue_script(
            'astra-child-sportcenter-js',
            get_stylesheet_directory_uri() . '/js/sportcenter.js',
            ['jquery'],
            null,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'astra_child_enqueue_scripts');

add_action('wp_head', function() {
    if (is_page()) {
        global $template;
        echo '<!-- TEMPLATE USED: ' . $template . ' -->';
    }
});

add_action('after_setup_theme', function() {
    add_image_size('category-thumb', 300, 200, true); // true = обрезка по центру
});








