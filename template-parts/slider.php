<?php $images = get_field('moments_gallery'); ?>
<div class="swiper moments-section__slider">
  <?php if( $images ): ?>
  <div class="swiper-wrapper moments-section__wrapper">
    <?php foreach( $images as $image ): ?>
    <div class="swiper-slide moments-section__photo">
      <div class="image-wrapper moments-section__image">
        <img class="swiper-lazy" loading="lazy" src="<?php echo esc_url($image['sizes']['medium_large']); ?>"
          alt="<?php echo esc_attr($image['alt']); ?>">
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>

  <?php get_template_part( 'template-parts/swiper-navigation'); ?>
</div>