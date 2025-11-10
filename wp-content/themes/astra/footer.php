<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<?php astra_content_bottom(); ?>
	</div> <!-- ast-container -->
	</div><!-- #content -->
<?php
	astra_content_after();

	astra_footer_before();

	astra_footer();

	astra_footer_after();
?>
	</div><!-- #page -->
<?php
	astra_body_bottom();
	wp_footer();
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const buttons = document.querySelectorAll(".toggle-tickets-btn");
  buttons.forEach((btn) => {
    btn.addEventListener("click", function() {
      const container = this.nextElementSibling;
      const isVisible = container.style.display === "block";
      
      container.style.display = isVisible ? "none" : "block";
      this.textContent = isVisible ? "View Tickets" : "Hide Tickets";
      this.classList.toggle("active", !isVisible);
    });
  });
});
</script>


</script>
	</body>
</html>

<?php
$blog_id = get_current_blog_id();
$custom_footer = get_template_directory() . "/templates/site{$blog_id}/footer-site{$blog_id}.php";

if ( file_exists( $custom_footer ) ) {
    include( $custom_footer );
}
// если файла нет, просто не добавляем второй футер — Astra сама выведет свой
?>


