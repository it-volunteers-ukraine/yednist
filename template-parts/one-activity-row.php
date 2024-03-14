<div class="activity__table-caption">
  <div class="activity__table--text">
    <p class="activity__title"><?php echo $post->post_title; ?></p>
    <ul class="activity__details">
      <li class="activity__details--box">
        <div class="activity__table--icon">
          <svg>
            <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_money"></use>
          </svg>
        </div>
        <div><?php the_field('activity_price'); ?></div>
      </li>
      <li class="activity__details--box">
        <div class="activity__table--icon">
          <svg>
            <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_people">
            </use>
          </svg>
        </div>
        <div>
          <?php the_field('activity_target'); ?>
        </div>
      </li>
    </ul>
  </div>

  <div class="activity__table--buttons">

    <?php get_template_part( 'template-parts/activity-buttons' ); ?>

    <?php $learn_more = get_field('activity_learn_more_btn');
      $post_id = get_the_ID();
      if($learn_more) { ?>
    <div class="learn__more--wrap">
      <button class="button secondary-button activity__button js-open-activity-form"
        data-post-id="<?php echo $post_id; ?>">
        <?php echo $learn_more; ?>
      </button>
      <div class="button__loader hidden"></div>
    </div>
    <?php } ?>
  </div>
</div>