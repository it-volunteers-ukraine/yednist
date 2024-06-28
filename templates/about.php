<?php
/*
Template Name: about
*/
get_header();
global $post;
?>
<main class="about">
  <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
  <section class="about__hero section">
    <div class="container">
      <div class="inner-container">
        <h2 class="about__title page-title"><?php the_field('about-title'); ?></h2>
        <div class="about__img">
          <img src="<?php the_field('about-img-hero'); ?>" alt="hero">
        </div>
        <div class="about__purpose">
          <div class="about__mission">
            <p><?php the_field('about-mission'); ?></p>
          </div>
          <div class="about__message">
            <div class="about__message-row">
              <div class="about__message-block about__message-first">
                <p><?php the_field('about-message-1'); ?></p>
              </div>
              <div class="about__message-block about__message-second">
                <p><?php the_field('about-message-2'); ?></p>
              </div>
            </div>
            <div class="about__message-column about__message-block">
              <p><?php the_field('about-message-3'); ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="about__activity section">
    <div class="container">
      <h2 class="about__activity-title section-title"><?php the_field('about-activity'); ?></h2>
      <div class="inner-container">
        <div class="about__activity-body">
          <p class="about__activity-text"><?php the_field('about-activity-text'); ?></p>
        </div>
      </div>
    </div>
  </section>

  <section class="section about_projects">
    <div class="container">
      <h2 class="section-title"><?php the_field('about_projects'); ?></h2>
      <div class="inner-container">

        <div>
          <?php
    $current_language = (function_exists('pll_current_language')) ? pll_current_language('name') : '';
    $parent_slug = ($current_language == 'EN') ? 'projects-en' : (($current_language == 'УКР') ? 'projects-uk' : 'projects-pl');
    $parent_page = get_page_by_path($parent_slug);
    $pages = get_pages(array(
        'parent' => $parent_page->ID,
        'number' => 3,
        'sort_column' => 'post_date',
        'sort_order' => 'DESC'
      ));
    $children = get_page_children($parent_page->ID, $pages);?>

          <?php foreach ($children as $child) { 
      if (have_rows('projects_descriptions', $parent_page->ID)) {
        the_row();
          
        get_template_part( 'template-parts/one-project', null, array('child' => $child, 'parent_page' => $parent_page));

       } ?>
          <?php } ?>
        </div>

        <a class="button primary-button about__projects--btn"
          href="<?php echo esc_attr(get_field('about_projects_btn_url') ); ?>"><?php the_field('about_projects_btn'); ?></a>

      </div>
    </div>
  </section>

  <section class="about__gallery section">
    <div class="container">
      <h2 class="about__gallery-title section-title"><?php the_field('about-gallery'); ?></h2>
      <div class="inner-container">
        <div class="about__gallery-body">
          <div class="gallery">
            <div class="gallery__body">
              <?php get_template_part( 'template-parts/gallery-section' ); ?>
              <div class="about__gallery-album">
                <div class="about__gallery-img"><img src="<?php the_field('about-img-album'); ?>" alt="album"></div>
                <a href="<?php the_field('about-gallery-link'); ?>"
                  class="about__gallery-link"><?php the_field('about-gallery-photo'); ?></a>
              </div>
            </div>
          </div>
          <div class="gallery-mobile">
            <?php get_template_part( 'template-parts/gallery-mobile' ); ?>
            <div class="gallery__body">
              <a href="<?php the_field('about-gallery-link'); ?>"
                class="about__gallery-link"><?php the_field('about-gallery-photo'); ?></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="about__history section">
    <div class="container">
      <h2 class="section-title"><?php the_field('about-history'); ?></h2>
      <div class="inner-container">
        <div class="about__history-body">
          <?php get_template_part( 'template-parts/about-history' ); ?>
        </div>
      </div>
    </div>
  </section>
  <?php get_template_part( 'template-parts/documents' ); ?>
</main>
<?php get_footer(); ?>