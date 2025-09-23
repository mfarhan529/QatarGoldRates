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
document.addEventListener("DOMContentLoaded", function () {
  const accordions = document.querySelectorAll(".elementor-accordion .elementor-accordion-item");

  accordions.forEach(item => {
    let header = item.querySelector(".elementor-tab-title");
    header.addEventListener("click", function () {
      item.classList.toggle("elementor-active");
      let content = item.querySelector(".elementor-tab-content");
      if (content.style.display === "block") {
        content.style.display = "none";
      } else {
        content.style.display = "block";
      }
    });
  });
});
</script>

 
	</body>
</html>
