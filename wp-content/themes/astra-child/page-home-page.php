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

<div class="sportcenter-description">
  <h2>Trainer Sessions</h2>
  <p>
    Choose your preferred training type with our professional coaches.
    We offer individual and group sessions for swimming, gym, or a combined triathlon preparation program.
    Fill in the registration form after selecting a ticket.
  </p>
</div>

<div class="trainer-tickets-row" style="display:flex; gap:20px; flex-wrap:wrap; margin-top:20px;">

    <!-- Тренировка в бассейне -->
    <div class="trainer-ticket" style="flex:1; min-width:250px; border:1px solid #ccc; padding:15px; border-radius:10px; text-align:center;">
        <h3>Swimming Session</h3>
        <p>Professional swimming training with our coach.</p>
        <button class="register-btn" data-target="swimming-form">Register</button>
    </div>

    <!-- Тренировка в зале -->
    <div class="trainer-ticket" style="flex:1; min-width:250px; border:1px solid #ccc; padding:15px; border-radius:10px; text-align:center;">
        <h3>Gym Session</h3>
        <p>Strength and conditioning training in our gym.</p>
        <button class="register-btn" data-target="gym-form">Register</button>
    </div>

    <!-- Подготовка к триатлону -->
    <div class="trainer-ticket" style="flex:1; min-width:250px; border:1px solid #ccc; padding:15px; border-radius:10px; text-align:center;">
        <h3>Triathlon Prep</h3>
        <p>Combined training in pool and gym for triathlon enthusiasts.</p>
        <button class="register-btn" data-target="triathlon-form">Register</button>
    </div>

</div>

<!-- Модальные формы регистрации (скрыты по умолчанию) -->
<div id="swimming-form" class="trainer-form" style="display:none;">
    <button class="close-form">× Close</button>
    <?php echo do_shortcode('[contact-form-7 id="3dd14b7" title="Swimming Registration"]'); ?>
</div>
<div id="gym-form" class="trainer-form" style="display:none;">
    <button class="close-form">× Close</button>
    <?php echo do_shortcode('[contact-form-7 id="d0c9d5f" title="Gym Registration"]'); ?>
</div>
<div id="triathlon-form" class="trainer-form" style="display:none;">
    <button class="close-form">× Close</button>
    <?php echo do_shortcode('[contact-form-7 id="7847fdb" title="Triathlon Registration"]'); ?>
</div>

<script>
let openForm = null; // Отслеживаем открытую форму

// Открытие формы
document.querySelectorAll('.register-btn').forEach(button => {
    button.addEventListener('click', () => {
        const targetId = button.getAttribute('data-target');
        const form = document.getElementById(targetId);

        if (openForm && openForm !== form) {
            openForm.style.display = 'none'; // Закрываем предыдущую форму
        }

        if(form){
            form.style.display = 'block';
            form.scrollIntoView({behavior: 'smooth'});
            openForm = form; // Запоминаем открытую форму
        }
    });
});

// Закрытие формы
document.querySelectorAll('.close-form').forEach(btn => {
    btn.addEventListener('click', () => {
        const parent = btn.parentElement;
        parent.style.display = 'none';
        if(openForm === parent){
            openForm = null; // Сбрасываем открытое окно
        }
    });
});
</script>


</div>

  </div>

</div>

<?php get_footer(); ?>






