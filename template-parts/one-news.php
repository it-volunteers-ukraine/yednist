<div class="lastnews">
  <?php  ?>
  <div class="lastnews_img_wrap">
    <div class="lastnews__img--box">
      <?php get_template_part('template-parts/check-thumbnail'); ?>
    </div>
  </div>
  <div class="lastnews_caption">

    <p class="lastnews__title"><?php the_title(); ?></p>
    <p class="lastnews__time"><?php the_time('d.m.Y'); ?></p>

    <?php $fullContent = get_the_content();
    $contentExcerpt = wp_trim_words($fullContent, 14, "..."); ?>

    <div class="lastnews__detais-box">
      <div class="lastnews__content--short"><?php echo $contentExcerpt?></div>

      <button id="" class='activity__modal--detais-open' type='button'><?php the_field('read_btn', 'option'); ?>
        <span class="activity__modal--detais--icon">
          <svg>
            <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon-small_arrow"></use>
          </svg>
        </span>
      </button>


      <div class="lastnews__content--full hidden">
        <?php if($fullContent) echo $fullContent; ?>
      </div>

    </div>

    <div class="lastnews__content"><?php echo $fullContent; ?></div>

  </div>
</div>