<?php

      $activity_name = 'activity_telegram';
      if( get_field('select_btn') == 'Зареєструватись' ) {
      $activity_name = 'activity_registration';
    }
      if( get_field('select_btn') == 'Купити квиток' ) {
      $activity_name = 'activity_buy_ticket';
    }

      $activity = get_field($activity_name);
      $class_name = $activity_name == 'activity_telegram' ? 'secondary-button':'primary-button';
      if( $activity ): ?>
<a class="button <?php echo $class_name; ?> activity__button" target="_blank"
  href="<?php echo esc_url( $activity['link'] ); ?>"><?php echo esc_html( $activity['btn'] ); ?></a>
<?php endif; ?>

<?php $learn_more = get_field('activity_learn_more_btn');
      if($learn_more) { ?>
<button class="button secondary-button activity__button"
  href="<?php the_permalink(); ?>"><?php  echo $learn_more; ?></button>
<?php } ?>