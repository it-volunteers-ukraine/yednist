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
          <?php
              $category = get_the_terms($post->ID, 'activities-target');
              foreach ($category as $cat) {
                echo $cat->name;
              }?>
        </div>
      </li>
    </ul>
  </div>

  <div class="activity__table--buttons">

    <?php get_template_part( 'template-parts/activity-buttons' ); ?>

  </div>
</div>