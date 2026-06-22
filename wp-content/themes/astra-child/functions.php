<?php
function astra_child_enqueue_styles() {
    // Подключаем стили родительской темы
    wp_enqueue_style(
        'astra-parent-style',
        get_template_directory_uri() . '/style.css'
    );

    // Подключаем стили дочерней темы с автообновлением
    wp_enqueue_style(
        'astra-child-style',
        get_stylesheet_uri(),
        ['astra-parent-style'],
        filemtime( get_stylesheet_directory() . '/style.css' )
    );
}
add_action('wp_enqueue_scripts', 'astra_child_enqueue_styles');

/*
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
*/

function astra_child_enqueue_scripts() {
    if ( is_page() ) {
        $template_slug = get_page_template_slug(); // вернёт 'page-home-page.php'
        if ( $template_slug === 'page-home-page.php' ) {
            wp_enqueue_script(
                'astra-child-sportcenter-js',
                get_stylesheet_directory_uri() . '/js/sportcenter.js',
                [],
                filemtime( get_stylesheet_directory() . '/js/sportcenter.js' ),
                true
            );
        }
    }
}
add_action('wp_enqueue_scripts', 'astra_child_enqueue_scripts');



// Отладка: показать, какой шаблон используется
add_action('wp_head', function() {
    if (is_page()) {
        global $template;
        echo '<!-- TEMPLATE USED: ' . $template . ' -->';
    }
});

// Добавляем собственный размер изображения
add_action('after_setup_theme', function() {
    add_image_size('category-thumb', 300, 200, true);
});

add_filter( 'wp_nav_menu_items', 'add_cart_count_to_menu', 10, 2 );
function add_cart_count_to_menu( $items, $args ) {
    // Проверяем, что это главное меню
    if ( $args->theme_location == 'primary' && function_exists('WC') ) {
        $count = WC()->cart->get_cart_contents_count();
        // Добавляем span с количеством рядом с пунктом меню "Cart"
        $items = str_replace(
            '>Cart<',
            '><span class="cart-count">' . $count . '</span>Cart<',
            $items
        );
    }
    return $items;
}

// AJAX обновление счетчика при добавлении товара
add_filter( 'woocommerce_add_to_cart_fragments', 'update_menu_cart_count' );
function update_menu_cart_count( $fragments ) {
    ob_start();
    ?>
    <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
    <?php
    $fragments['.menu-item a span.cart-count'] = ob_get_clean();
    return $fragments;
}

// Создание Custom Post Type "Staff Profile"
function create_staff_profile_cpt() {
    $labels = array(
        'name' => 'Staff Profiles',
        'singular_name' => 'Staff Profile',
        'add_new' => 'Add Staff Profile',
        'add_new_item' => 'Add New Staff Profile',
        'edit_item' => 'Edit Staff Profile',
        'new_item' => 'New Staff Profile',
        'view_item' => 'View Staff Profile',
        'search_items' => 'Search Staff Profiles',
        'not_found' => 'No Staff Profiles found',
        'not_found_in_trash' => 'No Staff Profiles found in Trash',
        'menu_name' => 'Staff Profiles',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-id',
        'supports' => array('title', 'editor', 'custom-fields'),
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'staff-profiles'),
    );

    register_post_type('staff_profile', $args);
}
add_action('init', 'create_staff_profile_cpt');

add_action('wpcf7_mail_sent', 'create_staff_profile_from_cf7');

function create_staff_profile_from_cf7($contact_form) {
    $submission = WPCF7_Submission::get_instance();
    if (!$submission) return;

    $data = $submission->get_posted_data();

    // Проверяем, какая форма отправлена по ID
    $form_id = $contact_form->id();
    
    if ($form_id == 3) { // ID формы плавания
        $full_name = sanitize_text_field($data['swim-name']);
        $email     = sanitize_email($data['swim-email']);
        $phone     = sanitize_text_field($data['swim-phone']);
        $shirt_size = sanitize_text_field($data['swim-shirt-size']); // если есть
        $hoodie_size = sanitize_text_field($data['swim-hoodie-size']); // если есть

        // Создаём новый Staff Profile
        $post_id = wp_insert_post(array(
            'post_title'  => $full_name,
            'post_type'   => 'staff_profile',
            'post_status' => 'publish',
        ));

        if ($post_id) {
            // Заполняем ACF поля
            update_field('full_name', $full_name, $post_id);
            update_field('email', $email, $post_id);
            update_field('phone', $phone, $post_id);
            update_field('shirt_size', $shirt_size, $post_id);
            update_field('hoodie_size', $hoodie_size, $post_id);
        }
    }

    // Можно добавить elseif для gym, triathlon форм
}

// functions.php
function staff_registration_form_shortcode() {
    ob_start();
    include get_stylesheet_directory() . '/staff-registration.php';
    return ob_get_clean();
}
add_shortcode('staff_registration', 'staff_registration_form_shortcode');

add_action('wpcf7_mail_sent', 'save_staff_registration');

function save_staff_registration($contact_form) {
    $title = $contact_form->title;

    if($title != 'Staff Registration') return; // Проверяем нужную форму

    $submission = WPCF7_Submission::get_instance();
    if(!$submission) return;

    $data = $submission->get_posted_data();

    $new_staff = array(
        'post_title' => sanitize_text_field($data['full-name']),
        'post_type' => 'staff_profile', // Твой CPT
        'post_status' => 'publish'
    );

    $post_id = wp_insert_post($new_staff);

    if($post_id) {
        update_field('full_name', sanitize_text_field($data['full-name']), $post_id);
        update_field('email', sanitize_email($data['email']), $post_id);
        update_field('phone', sanitize_text_field($data['phone']), $post_id);
        update_field('role', sanitize_text_field($data['role']), $post_id);
        update_field('group', sanitize_text_field($data['group']), $post_id);

        // Products (checkbox)
        if(isset($data['products'])) {
            update_field('products', $data['products'], $post_id);
        }

        update_field('t_shirt_size', sanitize_text_field($data['t-shirt-size']), $post_id);
        update_field('hoodie_size', sanitize_text_field($data['hoodie-size']), $post_id);

        update_field('accommodation_needed', !empty($data['accommodation-needed']) ? 1 : 0, $post_id);
        update_field('accommodation_details', sanitize_text_field($data['accommodation-details']), $post_id);

        // Passes & Driving Permits – сохраняем как массив строк
        update_field('passes', explode("\n", $data['passes']), $post_id);
        update_field('driving_permits', explode("\n", $data['driving-permits']), $post_id);

        update_field('status', sanitize_text_field($data['status']), $post_id);
    }
}

// DevOps practice branch







