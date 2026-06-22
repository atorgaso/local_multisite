<?php
/*
Template Name: Staff Registration
*/
get_header(); ?>

<div class="staff-registration-main">

  <!-- Заголовок и описание -->
  <div class="staff-registration-description">
      <h2>Staff Registration</h2>
      <p>
        Register yourself or your group for staff passes, shifts, and equipment.
        Fill in your details carefully. You can also register multiple team members at once.
      </p>
  </div>

  <!-- Контейнер с вариантами регистрации -->
  <div id="staff-categories" class="staff-categories">

      <!-- Swimming Staff -->
      <div class="staff-category-block">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/staff-swimming.jpg" alt="Swimming Staff" class="category-thumb">
          <h3>Swimming Staff</h3>
          <p>Register for swimming-related staff duties and equipment.</p>

          <button class="toggle-staff-form-btn" data-category="Swimming Staff">Register</button>
      </div>

      <!-- Gym Staff -->
      <div class="staff-category-block">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/staff-gym.jpg" alt="Gym Staff" class="category-thumb">
          <h3>Gym Staff</h3>
          <p>Register for gym-related staff duties and equipment.</p>

          <button class="toggle-staff-form-btn" data-category="Gym Staff">Register</button>
      </div>

      <!-- Triathlon Staff -->
      <div class="staff-category-block">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/staff-triathlon.jpg" alt="Triathlon Staff" class="category-thumb">
          <h3>Triathlon Staff</h3>
          <p>Register for triathlon-related staff duties and equipment.</p>

          <button class="toggle-staff-form-btn" data-category="Triathlon Staff">Register</button>
      </div>

  </div>
</div>

<!-- Модальная форма (одна для всех категорий) -->
<div id="staff-form-modal" class="staff-form" style="display:none;">
    <button class="close-form">× Close</button>
    <?php echo do_shortcode('[contact-form-7 id="5c07088" title="Staff Registration Form"]'); ?>
</div>

<!-- JS для открытия/закрытия формы -->
<script>
document.querySelectorAll('.toggle-staff-form-btn').forEach(button => {
    button.addEventListener('click', () => {
        const category = button.getAttribute('data-category');

        // Подставляем выбранную категорию в скрытое поле формы
        const formInput = document.querySelector('#staff-form-modal input[name="staff_category"]');
        if(formInput) {
            formInput.value = category;
        }

        // Скрываем и открываем модалку
        const modal = document.getElementById('staff-form-modal');
        modal.style.display = 'block';
        modal.scrollIntoView({behavior: 'smooth'});
    });
});

// Кнопка Close
document.querySelector('#staff-form-modal .close-form').addEventListener('click', () => {
    document.getElementById('staff-form-modal').style.display = 'none';
});
</script>

<?php get_footer(); ?>


<!-- CSS стили -->
<style>
.staff-registration-main {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
}

.staff-registration-description h2 {
    color: #ff9800;
    text-align: center;
}

.staff-registration-description p {
    color: #e0e0e0;
    text-align: center;
    margin-top: 10px;
}

.staff-categories {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center;
    margin-top: 40px;
}

.staff-category-block {
    background: #1b1b1b;
    border-radius: 16px;
    padding: 20px;
    max-width: 320px;
    text-align: center;
}

.staff-category-block h3 {
    color: #ff9800;
    margin-bottom: 10px;
}

.staff-category-block p {
    color: #ccc;
    margin-bottom: 15px;
}

.staff-category-block img.category-thumb {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 15px;
}

.toggle-staff-form-btn {
    background-color: #ff9800;
    color: #fff;
    padding: 10px 25px;
    border-radius: 50px;
    font-weight: bold;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.toggle-staff-form-btn:hover {
    background-color: #e68a00;
}

/* Модальная форма */
.staff-form {
    background-color: #222;           /* темный фон */
    padding: 50px 20px 20px 20px;    /* увеличили верхний padding, чтобы кнопка Close не перекрывала поля */
    margin: 20px 0;
    border-radius: 10px;
    color: #fff;                      /* текст формы белый */
    position: relative;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

/* Кнопка Close */
.staff-form .close-form {
    background: transparent;
    color: #fff;
    font-size: 22px;
    border: none;
    cursor: pointer;
    position: absolute;
    top: 10px;
    right: 15px;
    z-index: 10;                      /* кнопка поверх формы */
}

/* Поля формы */
.staff-form input,
.staff-form select,
.staff-form textarea {
    background-color: #333;
    border: 1px solid #555;
    padding: 10px;                    /* внутренний padding */
    border-radius: 5px;
    width: 100%;
    margin-bottom: 15px;              /* расстояние между полями */
    color: #fff;
}

/* Кнопка Submit */
.staff-form .wpcf7-submit {
    background-color: #ff6600;        /* оранжевая кнопка */
    color: #fff;
    padding: 12px 25px;
    border-radius: 50px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s ease;
}
.staff-form .wpcf7-submit:hover {
    background-color: #e65c00;
}

/* Заголовки и лейблы */
.staff-form label {
    display: block;
    margin-bottom: 10px;               /* чуть отступ под лейблом */
}


</style>

<?php get_footer(); ?>


