<div class="feedback-backdrop" id="js-feedback-form">
  <div class="feedback-modal">

    <div class="feedback-modal__title-wrap">
      <h1 class="feedback-modal__title"><?php the_field('feedback_form_title'); ?></h1>
      <button class="feedback-modal__btn" type="button" id="js-close-feedback-form">
        <svg class="icon__cross">
          <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#cross-icon"></use>
        </svg>
      </button>
    </div>

    <?php
         if ( have_posts() ) :
            while(have_posts()): the_post(); 


            acf_form(array(
                  'post_id'       => 'new_post',
                  'new_post'      => array(
                      'post_type'     => 'feedbacks',
                      'post_status'   => 'draft',
                  ),
                  'html_submit_button'  => '<input type="submit" class="acf-button button primary-button" value="Відправити" />',
              )); 


              endwhile;     
             else : ?>
    <p class="">Nothing found</p>
    <?php endif; ?>

  </div>
</div>