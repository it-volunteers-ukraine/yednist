<?php
/*
Template Name: thank-you
*/
$text = get_field('thank_text');

$url = $_SERVER['REQUEST_URI'];
$parsed_url = parse_url($url);
if (isset($parsed_url['query'])) {
     $text = get_field('thank_error_text');
}

get_header();

?>
<main class="main">
  <section class="breadcrumbs__section">
    <div class="container">
      <div class="breadcrumbs__line"></div>
    </div>
  </section>
  <section class="section thank__section">
    <div class="container">
      <div class="inner-container thank__section--container">
        <div class="thank__section--text">
          <?php echo $text; ?>
        </div>
        <a class="button primary-button thank__section--button"
          href='<?php the_field('back_to_home_link'); ?>'><?php the_field('back_to_home'); ?></a>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>