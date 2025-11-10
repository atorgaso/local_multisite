<?php
/*
Template Name: Sport Center
*/
get_header(); ?>

<div class="sportcenter-main">

  <div class="sportcenter-categories">

<div class="sportcenter-description">
  <h2>ABOUT OUR CENTER</h2>
  <p>
    Our Sport Center combines modern facilities, professional trainers, and a welcoming atmosphere.
    Whether you prefer swimming, strength training, or a mix of both — we have a membership that fits your goals.
  </p>
</div>

<div id="categories" class="sportcenter-categories">

  <div class="category-block">
    <?php 
    // Pool image
    $pool_img_url = get_stylesheet_directory_uri() . '/images/pool.jpg';
    $pool_attachment_id = attachment_url_to_postid($pool_img_url);

    // Выводим изображение фиксированного размера 'category-thumb' (300x200)
    if ($pool_attachment_id) {
        echo wp_get_attachment_image($pool_attachment_id, 'category-thumb', false, array(
            'alt' => 'Pool',
            'class' => 'category-thumb'
        ));
    } else {
        // Если изображение не найдено, выводим обычный <img>
        echo '<img src="' . esc_url($pool_img_url) . '" alt="Pool" class="category-thumb">';
    }
    ?>
    
    <h2>Pool</h2>
    <p>Relax and stay fit in our 25m temperature-controlled swimming pool.</p>

    <!-- Кнопка -->
    <button class="toggle-tickets-btn">View Tickets</button>

    <!-- Контейнер с товарами -->
    <div class="tickets-container" style="display: none;">
        <?php echo do_shortcode('[products category="pool" columns="1"]'); ?>
    </div>
</div>

<div class="category-block">
    <?php 
    // Gym image
    $gym_img_url = get_stylesheet_directory_uri() . '/images/gym.jpeg';
    $gym_attachment_id = attachment_url_to_postid($gym_img_url);

    if ($gym_attachment_id) {
        echo wp_get_attachment_image($gym_attachment_id, 'category-thumb', false, array(
            'alt' => 'Gym',
            'class' => 'category-thumb'
        ));
    } else {
        echo '<img src="' . esc_url($gym_img_url) . '" alt="Gym" class="category-thumb">';
    }
    ?>
    <h2>Gym</h2>
    <p>Modern gym with professional equipment for every level.</p>

    <!-- Кнопка -->
    <button class="toggle-tickets-btn">View Tickets</button>

    <!-- Контейнер с товарами -->
    <div class="tickets-container" style="display: none;">
        <?php echo do_shortcode('[products category="gym" columns="1"]'); ?>
    </div>
</div>

<div class="category-block">
    <?php 
    // Pool + Gym image
    $poolgym_img_url = get_stylesheet_directory_uri() . '/images/pool-gym.jpg';
    $poolgym_attachment_id = attachment_url_to_postid($poolgym_img_url);

    if ($poolgym_attachment_id) {
        echo wp_get_attachment_image($poolgym_attachment_id, 'category-thumb', false, array(
            'alt' => 'Pool + Gym',
            'class' => 'category-thumb'
        ));
    } else {
        echo '<img src="' . esc_url($poolgym_img_url) . '" alt="Pool + Gym" class="category-thumb">';
    }
    ?>
    <h2>Pool + Gym</h2>
    <p>Can’t choose? Enjoy the best of both worlds with a combo membership.</p>

    <!-- Кнопка -->
    <button class="toggle-tickets-btn">View Tickets</button>

    <!-- Контейнер с товарами -->
    <div class="tickets-container" style="display: none;">
        <?php echo do_shortcode('[products category="pool-gym" columns="1"]'); ?>
    </div>
</div>


</div>

  </div>

</div>

<?php get_footer(); ?>






